<?php

namespace App\Services;

class CareerService
{
    private const LOKER_PROFILE_URL = 'https://www.loker.id/profile/sekanca-media-digital';

    private const GLINTS_PROFILE_URL = 'https://glints.com/companies/sekanca-media-digital/a36cc466-518b-403a-a58b-181eec54ee90';

    /**
     * Get job listings. Sync data from https://www.loker.id/profile/sekanca-media-digital
     * TODO: Connect to database or API when ready.
     */
    public function getJobListings(): array
    {
        return [
            [
                'title' => 'IT Staff - IT Support - CCTV',
                'location' => 'Jakarta Barat',
                'type' => 'Full-time',
                'description' => 'Menangani dukungan IT, help desk, dan instalasi/pemeliharaan sistem CCTV. Memahami troubleshooting hardware, jaringan, dan sistem keamanan.',
                'apply_url' => 'https://www.loker.id/information-technology/help-desk-it-support/it-staff-it-support-cctv-sekanca-media-digital-jakarta-barat.html',
            ],
            [
                'title' => 'Finance & Accounting',
                'location' => 'Jakarta Barat',
                'type' => 'Full-time',
                'description' => 'Mengelola keuangan dan akuntansi perusahaan. Bertanggung jawab atas pembukuan, laporan keuangan, dan proses finansial sehari-hari.',
                'apply_url' => 'https://www.loker.id/akuntansi-keuangan/akuntansi-finansial/finance-accounting-sekanca-media-digital-jakarta-barat.html',
                'glints_url' => 'https://glints.com/id/en/opportunities/jobs/finance-and-accounting/2d9589d2-ecad-49f0-b45b-216ab411f7db',
            ],
        ];
    }

    public function getLokerProfileUrl(): string
    {
        return self::LOKER_PROFILE_URL;
    }

    public function getGlintsProfileUrl(): string
    {
        return self::GLINTS_PROFILE_URL;
    }
}
