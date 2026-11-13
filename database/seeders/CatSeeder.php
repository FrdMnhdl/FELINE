<?php

namespace Database\Seeders;

use App\Models\Cat;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class CatSeeder extends Seeder
{
    /**
     * Seed the gallery with curated sample cat records and local photographs.
     */
    public function run(): void
    {
        if (Cat::query()->exists()) {
            return;
        }

        $admin = User::query()->where('role', User::ROLE_ADMIN)->first();
        if (! $admin) {
            return;
        }

        $samples = [
            [
                'name' => 'Miso',
                'breed' => 'Tabby Oren',
                'age' => '2 tahun',
                'gender' => 'Jantan',
                'description' => 'Anabul santai yang hobi banget berjemur di sudut jendela pagi hari. Miso paling suka nyapa pengunjung pakai kedipan pelan sebelum tidur siang lagi.',
                'asset' => 'miso.webp',
            ],
            [
                'name' => 'Sora',
                'breed' => 'Russian Blue',
                'age' => '3 tahun',
                'gender' => 'Betina',
                'description' => 'Berbulu abu-abu lembut dengan mata hijau cerah yang tajam. Sora suka nongkrong di tempat tinggi sambil mantau suasana ruangan dengan kalem.',
                'asset' => 'sora.webp',
            ],
            [
                'name' => 'Yuzu',
                'breed' => 'Scottish Fold',
                'age' => '1 tahun',
                'gender' => 'Jantan',
                'description' => 'Punya kuping lipat yang gemesin dan warna bulu krem hangat. Yuzu paling betah rebahan di dekat tumpukan kain linen pas suasana lagi tenang.',
                'asset' => 'yuzu.webp',
            ],
            [
                'name' => 'Kuro',
                'breed' => 'Bombay',
                'age' => '4 tahun',
                'gender' => 'Jantan',
                'description' => 'Bulu hitam mengkilap sama mata kuning keemasan yang mencolok. Kuro jalannya luwes banget dan nggak pernah kelewatan ngejar bayangan cahaya sore.',
                'asset' => 'kuro.webp',
            ],
            [
                'name' => 'Mochi',
                'breed' => 'Belang Tiga (Calico)',
                'age' => '10 bulan',
                'gender' => 'Betina',
                'description' => 'Penghuni paling muda yang aktif tapi tetap manis, punya corak oranye dan hitam rapi di bulu putihnya. Setiap pagi selalu keliling ngecek semua sudut galeri.',
                'asset' => 'mochi.webp',
            ],
            [
                'name' => 'Hana',
                'breed' => 'Ragdoll',
                'age' => '5 tahun',
                'gender' => 'Betina',
                'description' => 'Warnanya krem lembut dengan mata biru langit yang adem banget dilihat. Hana anaknya manja dan betah rebahan lama di atas bantal wol favoritnya.',
                'asset' => 'hana.webp',
            ],
        ];

        $disk = Storage::disk('public');

        foreach ($samples as $sample) {
            $sourcePath = database_path('seeders/images/'.$sample['asset']);
            $targetPath = 'cats/'.$sample['asset'];

            if (File::exists($sourcePath)) {
                $disk->put($targetPath, File::get($sourcePath));
            }

            $admin->cats()->create([
                'name' => $sample['name'],
                'breed' => $sample['breed'],
                'age' => $sample['age'],
                'gender' => $sample['gender'],
                'description' => $sample['description'],
                'image_path' => $targetPath,
            ]);
        }
    }
}
