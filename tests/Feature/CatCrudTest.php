<?php

namespace Tests\Feature;

use App\Models\Cat;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CatCrudTest extends TestCase
{
    use RefreshDatabase;

    private function makeValidPngUpload(string $clientFilename = 'cat.png', int $width = 320, int $height = 400): UploadedFile
    {
        $rawRows = '';
        for ($y = 0; $y < $height; $y++) {
            $rawRows .= "\x00".str_repeat("\xF2\x8C\x28", $width);
        }

        $ihdrData = pack('N2C5', $width, $height, 8, 2, 0, 0, 0);
        $idatData = gzcompress($rawRows);

        $chunk = static function (string $type, string $data): string {
            return pack('N', strlen($data)).$type.$data.pack('N', crc32($type.$data));
        };

        $pngBinary = "\x89PNG\r\n\x1a\n"
            .$chunk('IHDR', $ihdrData)
            .$chunk('IDAT', $idatData)
            .$chunk('IEND', '');

        return UploadedFile::fake()->createWithContent($clientFilename, $pngBinary);
    }

    public function test_admin_can_create_cat_with_uploaded_photograph_and_view_in_gallery(): void
    {
        Storage::fake('public');
        $admin = User::factory()->admin()->create();
        $upload = $this->makeValidPngUpload('my ../../dangerous-filename.png');

        $response = $this->actingAs($admin)->post(route('admin.cats.store'), [
            'name' => 'Miso',
            'breed' => 'Tabby Oren',
            'age' => '2 tahun',
            'gender' => 'Jantan',
            'description' => 'Anabul oren yang hobi berjemur pagi hari.',
            'image' => $upload,
        ]);

        $response->assertRedirect(route('cats.index'));

        $cat = Cat::query()->first();
        $this->assertNotNull($cat);
        $this->assertSame('Miso', $cat->name);
        $this->assertSame($admin->id, $cat->created_by);
        $this->assertStringStartsWith('cats/', $cat->image_path);
        $this->assertStringNotContainsString('dangerous-filename', $cat->image_path);

        Storage::disk('public')->assertExists($cat->image_path);

        $this->actingAs($admin)
            ->get(route('cats.index'))
            ->assertOk()
            ->assertSee('Miso')
            ->assertSee('Tabby Oren')
            ->assertSee($cat->thumbnailUrl(), false);
    }

    public function test_admin_can_edit_cat_information_without_replacing_photograph(): void
    {
        Storage::fake('public');
        $admin = User::factory()->admin()->create();
        $originalPath = 'cats/original-portrait.webp';
        Storage::disk('public')->put($originalPath, 'existing-image-bytes');

        $cat = Cat::factory()->create([
            'name' => 'Sora',
            'breed' => 'Russian Blue',
            'image_path' => $originalPath,
            'created_by' => $admin->id,
        ]);

        $response = $this->actingAs($admin)->put(route('admin.cats.update', $cat), [
            'name' => 'Sora Updated',
            'breed' => 'Russian Blue',
            'age' => '4 tahun',
            'gender' => 'Betina',
            'description' => 'Catatan terbaru buat Sora di galeri.',
        ]);

        $response->assertRedirect(route('cats.show', $cat));

        $fresh = $cat->fresh();
        $this->assertSame('Sora Updated', $fresh->name);
        $this->assertSame('4 tahun', $fresh->age);
        $this->assertSame($originalPath, $fresh->image_path);
        Storage::disk('public')->assertExists($originalPath);

        $this->actingAs($admin)
            ->get(route('cats.show', $cat))
            ->assertOk()
            ->assertSee('Sora Updated')
            ->assertSee('Catatan terbaru buat Sora di galeri.');
    }

    public function test_admin_replacing_cat_photograph_stores_new_image_and_cleans_up_previous_file(): void
    {
        Storage::fake('public');
        $admin = User::factory()->admin()->create();

        $oldPath = 'cats/old-uuid.webp';
        $oldThumbPath = 'cats/thumbs/old-uuid.webp';
        Storage::disk('public')->put($oldPath, 'old-bytes');
        Storage::disk('public')->put($oldThumbPath, 'old-thumb-bytes');

        $cat = Cat::factory()->create([
            'image_path' => $oldPath,
            'created_by' => $admin->id,
        ]);

        $replacement = $this->makeValidPngUpload('replacement.png');

        $response = $this->actingAs($admin)->put(route('admin.cats.update', $cat), [
            'name' => $cat->name,
            'breed' => $cat->breed,
            'age' => $cat->age,
            'gender' => $cat->gender,
            'description' => $cat->description,
            'image' => $replacement,
        ]);

        $response->assertRedirect(route('cats.show', $cat));

        $fresh = $cat->fresh();
        $this->assertNotSame($oldPath, $fresh->image_path);
        Storage::disk('public')->assertExists($fresh->image_path);
        Storage::disk('public')->assertMissing($oldPath);
        Storage::disk('public')->assertMissing($oldThumbPath);
    }

    public function test_admin_can_delete_cat_and_clean_up_stored_image(): void
    {
        Storage::fake('public');
        $admin = User::factory()->admin()->create();

        $imagePath = 'cats/delete-target.webp';
        $thumbPath = 'cats/thumbs/delete-target.webp';
        Storage::disk('public')->put($imagePath, 'bytes');
        Storage::disk('public')->put($thumbPath, 'thumb-bytes');

        $cat = Cat::factory()->create([
            'name' => 'Yuzu',
            'image_path' => $imagePath,
            'created_by' => $admin->id,
        ]);

        $response = $this->actingAs($admin)->delete(route('admin.cats.destroy', $cat));

        $response->assertRedirect(route('cats.index'));
        $this->assertDatabaseMissing('cats', ['id' => $cat->id]);
        Storage::disk('public')->assertMissing($imagePath);
        Storage::disk('public')->assertMissing($thumbPath);
    }

    public function test_deleting_missing_cat_returns_404(): void
    {
        $admin = User::factory()->admin()->create();

        $this->actingAs($admin)
            ->delete('/admin/cats/999999')
            ->assertNotFound();
    }

    public function test_regular_user_can_view_gallery_and_detail_without_admin_controls(): void
    {
        $user = User::factory()->create();
        $cat = Cat::factory()->create([
            'name' => 'Kuro',
            'breed' => 'Bombay',
        ]);

        $this->actingAs($user)
            ->get(route('cats.index'))
            ->assertOk()
            ->assertSee('Kuro')
            ->assertDontSee(route('admin.cats.create'))
            ->assertDontSee(route('admin.cats.edit', $cat))
            ->assertDontSee('data-delete-trigger', false);

        $this->actingAs($user)
            ->get(route('cats.show', $cat))
            ->assertOk()
            ->assertSee('Kuro')
            ->assertSee('Bombay')
            ->assertDontSee(route('admin.cats.edit', $cat))
            ->assertDontSee('data-delete-trigger', false);
    }

    public function test_invalid_image_uploads_are_rejected(): void
    {
        Storage::fake('public');
        $admin = User::factory()->admin()->create();

        $textFile = UploadedFile::fake()->create('notes.txt', 10, 'text/plain');
        $this->actingAs($admin)
            ->post(route('admin.cats.store'), [
                'name' => 'Invalid File',
                'breed' => 'Tabby',
                'age' => '1 tahun',
                'gender' => 'Jantan',
                'description' => 'Testing invalid MIME.',
                'image' => $textFile,
            ])
            ->assertSessionHasErrors('image');

        $tinyPng = $this->makeValidPngUpload('tiny.png', 40, 40);
        $this->actingAs($admin)
            ->post(route('admin.cats.store'), [
                'name' => 'Tiny Image',
                'breed' => 'Tabby',
                'age' => '1 tahun',
                'gender' => 'Jantan',
                'description' => 'Testing minimum dimensions.',
                'image' => $tinyPng,
            ])
            ->assertSessionHasErrors('image');

        $oversizedPng = UploadedFile::fake()->create('huge.png', 2500, 'image/png');
        $this->actingAs($admin)
            ->post(route('admin.cats.store'), [
                'name' => 'Huge File',
                'breed' => 'Tabby',
                'age' => '1 tahun',
                'gender' => 'Jantan',
                'description' => 'Testing max file size.',
                'image' => $oversizedPng,
            ])
            ->assertSessionHasErrors('image');

        $this->assertDatabaseCount('cats', 0);
    }

    public function test_invalid_form_data_returns_validation_errors(): void
    {
        $admin = User::factory()->admin()->create();

        $this->actingAs($admin)
            ->post(route('admin.cats.store'), [
                'name' => '',
                'breed' => '',
                'age' => '',
                'gender' => 'Unknown',
                'description' => '',
            ])
            ->assertSessionHasErrors(['name', 'breed', 'age', 'gender', 'description', 'image']);
    }
}
