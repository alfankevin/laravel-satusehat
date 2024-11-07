<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Pasien;
use App\Models\Pendaftaran;
use App\Models\Poli;
use App\Models\Practitioner;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Carbon;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\PendaftaranController
 */
final class PendaftaranControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $pendaftarans = Pendaftaran::factory()->count(3)->create();

        $response = $this->get(route('pendaftarans.index'));

        $response->assertOk();
        $response->assertViewIs('pendaftaran.index');
        $response->assertViewHas('pendaftarans');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PendaftaranController::class,
            'store',
            \App\Http\Requests\PendaftaranStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $tglDaftar = Carbon::parse($this->faker->date());
        $keluhan = $this->faker->word();
        $kunjSakit = $this->faker->word();
        $sistole = $this->faker->randomFloat(/** float_attributes **/);
        $diastole = $this->faker->randomFloat(/** float_attributes **/);
        $beratBadan = $this->faker->randomFloat(/** float_attributes **/);
        $tinggiBadan = $this->faker->randomFloat(/** float_attributes **/);
        $respRate = $this->faker->randomFloat(/** float_attributes **/);
        $lingkarPerut = $this->faker->randomFloat(/** float_attributes **/);
        $heartRate = $this->faker->randomFloat(/** float_attributes **/);
        $rujukBalik = $this->faker->numberBetween(-10000, 10000);
        $kdTkp = $this->faker->numberBetween(-10000, 10000);
        $created_by = $this->faker->numberBetween(-10000, 10000);
        $updated_by = $this->faker->numberBetween(-10000, 10000);
        $deleted_at = Carbon::parse($this->faker->dateTime());
        $deleted_by = $this->faker->numberBetween(-10000, 10000);
        $pasien = Pasien::factory()->create();
        $poli = Poli::factory()->create();
        $practitioner = Practitioner::factory()->create();

        $response = $this->post(route('pendaftarans.store'), [
            'tglDaftar' => $tglDaftar->toDateString(),
            'keluhan' => $keluhan,
            'kunjSakit' => $kunjSakit,
            'sistole' => $sistole,
            'diastole' => $diastole,
            'beratBadan' => $beratBadan,
            'tinggiBadan' => $tinggiBadan,
            'respRate' => $respRate,
            'lingkarPerut' => $lingkarPerut,
            'heartRate' => $heartRate,
            'rujukBalik' => $rujukBalik,
            'kdTkp' => $kdTkp,
            'created_by' => $created_by,
            'updated_by' => $updated_by,
            'deleted_at' => $deleted_at->toDateTimeString(),
            'deleted_by' => $deleted_by,
            'pasien_id' => $pasien->id,
            'poli_id' => $poli->id,
            'practitioner_id' => $practitioner->id,
        ]);

        $pendaftarans = Pendaftaran::query()
            ->where('tglDaftar', $tglDaftar)
            ->where('keluhan', $keluhan)
            ->where('kunjSakit', $kunjSakit)
            ->where('sistole', $sistole)
            ->where('diastole', $diastole)
            ->where('beratBadan', $beratBadan)
            ->where('tinggiBadan', $tinggiBadan)
            ->where('respRate', $respRate)
            ->where('lingkarPerut', $lingkarPerut)
            ->where('heartRate', $heartRate)
            ->where('rujukBalik', $rujukBalik)
            ->where('kdTkp', $kdTkp)
            ->where('created_by', $created_by)
            ->where('updated_by', $updated_by)
            ->where('deleted_at', $deleted_at)
            ->where('deleted_by', $deleted_by)
            ->where('pasien_id', $pasien->id)
            ->where('poli_id', $poli->id)
            ->where('practitioner_id', $practitioner->id)
            ->get();
        $this->assertCount(1, $pendaftarans);
        $pendaftaran = $pendaftarans->first();

        $response->assertRedirect(route('pendaftaran.index'));
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PendaftaranController::class,
            'update',
            \App\Http\Requests\PendaftaranUpdateRequest::class
        );
    }

    #[Test]
    public function update_saves_and_redirects(): void
    {
        $pendaftaran = Pendaftaran::factory()->create();
        $tglDaftar = Carbon::parse($this->faker->date());
        $keluhan = $this->faker->word();
        $kunjSakit = $this->faker->word();
        $sistole = $this->faker->randomFloat(/** float_attributes **/);
        $diastole = $this->faker->randomFloat(/** float_attributes **/);
        $beratBadan = $this->faker->randomFloat(/** float_attributes **/);
        $tinggiBadan = $this->faker->randomFloat(/** float_attributes **/);
        $respRate = $this->faker->randomFloat(/** float_attributes **/);
        $lingkarPerut = $this->faker->randomFloat(/** float_attributes **/);
        $heartRate = $this->faker->randomFloat(/** float_attributes **/);
        $rujukBalik = $this->faker->numberBetween(-10000, 10000);
        $kdTkp = $this->faker->numberBetween(-10000, 10000);
        $created_by = $this->faker->numberBetween(-10000, 10000);
        $updated_by = $this->faker->numberBetween(-10000, 10000);
        $deleted_at = Carbon::parse($this->faker->dateTime());
        $deleted_by = $this->faker->numberBetween(-10000, 10000);
        $pasien = Pasien::factory()->create();
        $poli = Poli::factory()->create();
        $practitioner = Practitioner::factory()->create();

        $response = $this->put(route('pendaftarans.update', $pendaftaran), [
            'tglDaftar' => $tglDaftar->toDateString(),
            'keluhan' => $keluhan,
            'kunjSakit' => $kunjSakit,
            'sistole' => $sistole,
            'diastole' => $diastole,
            'beratBadan' => $beratBadan,
            'tinggiBadan' => $tinggiBadan,
            'respRate' => $respRate,
            'lingkarPerut' => $lingkarPerut,
            'heartRate' => $heartRate,
            'rujukBalik' => $rujukBalik,
            'kdTkp' => $kdTkp,
            'created_by' => $created_by,
            'updated_by' => $updated_by,
            'deleted_at' => $deleted_at->toDateTimeString(),
            'deleted_by' => $deleted_by,
            'pasien_id' => $pasien->id,
            'poli_id' => $poli->id,
            'practitioner_id' => $practitioner->id,
        ]);

        $pendaftarans = Pendaftaran::query()
            ->where('tglDaftar', $tglDaftar)
            ->where('keluhan', $keluhan)
            ->where('kunjSakit', $kunjSakit)
            ->where('sistole', $sistole)
            ->where('diastole', $diastole)
            ->where('beratBadan', $beratBadan)
            ->where('tinggiBadan', $tinggiBadan)
            ->where('respRate', $respRate)
            ->where('lingkarPerut', $lingkarPerut)
            ->where('heartRate', $heartRate)
            ->where('rujukBalik', $rujukBalik)
            ->where('kdTkp', $kdTkp)
            ->where('created_by', $created_by)
            ->where('updated_by', $updated_by)
            ->where('deleted_at', $deleted_at)
            ->where('deleted_by', $deleted_by)
            ->where('pasien_id', $pasien->id)
            ->where('poli_id', $poli->id)
            ->where('practitioner_id', $practitioner->id)
            ->get();
        $this->assertCount(1, $pendaftarans);
        $pendaftaran = $pendaftarans->first();

        $response->assertRedirect(route('pendaftaran.index'));
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $pendaftaran = Pendaftaran::factory()->create();

        $response = $this->delete(route('pendaftarans.destroy', $pendaftaran));

        $response->assertRedirect(route('pendaftaran.index'));

        $this->assertModelMissing($pendaftaran);
    }
}
