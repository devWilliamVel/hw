<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PetModel extends Model
{
    public $timestamps = false;

    protected $table = 'pets';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'very_strong_against',
        'strong_against',
        'very_weak_against',
        'weak_against',
    ];

    const START_ONE = 1;
    const START_TWO = 2;
    const START_THREE = 3;
    const START_FOUR = 4;
    const START_FIVE = 5;
    const START_SIX = 6;

    const RANGE_GREY_0 = 1;
    const RANGE_GREEN_0 = 2;
    const RANGE_GREEN_1 = 3;
    const RANGE_BLUE_0 = 4;
    const RANGE_BLUE_1 = 5;
    const RANGE_BLUE_2 = 6;
    const RANGE_PURPLE_0 = 7;
    const RANGE_PURPLE_1 = 8;
    const RANGE_PURPLE_2 = 9;
    const RANGE_PURPLE_3 = 10;

    public static function getStars ()
    {
        return [
            self::START_ONE,
            self::START_TWO,
            self::START_THREE,
            self::START_FOUR,
            self::START_FIVE,
            self::START_SIX,
        ];
    }

    public static function getRanges ()
    {
        return [
            self::RANGE_GREY_0 => __('general.grey_0'),
            self::RANGE_GREEN_0 => __('general.green_0'),
            self::RANGE_GREEN_1 => __('general.green_1'),
            self::RANGE_BLUE_0 => __('general.blue_0'),
            self::RANGE_BLUE_1 => __('general.blue_1'),
            self::RANGE_BLUE_2 => __('general.blue_2'),
            self::RANGE_PURPLE_0 => __('general.purple_0'),
            self::RANGE_PURPLE_1 => __('general.purple_1'),
            self::RANGE_PURPLE_2 => __('general.purple_2'),
            self::RANGE_PURPLE_3 => __('general.purple_3'),
        ];
    }

    public function getRange ( $range )
    {
        $ranges = self::getRanges();

        return $ranges[$range];
    }

    public function getPetsVSA () : array
    {
        return $this->getVSPets($this->very_strong_against ?? '');
    }

    public function getPetsSA () : array
    {
        return $this->getVSPets($this->strong_against ?? '');
    }

    public function getPetsVWA () : array
    {
        return $this->getVSPets($this->very_weak_against ?? '');
    }

    public function getPetsWA () : array
    {
        return $this->getVSPets($this->weak_against ?? '');
    }

    public function removeVSPet ()
    {
        if ( ! empty($this->very_strong_against) )
            foreach (explode(' ', $this->very_strong_against) as $petId)
            {
                $petAux = PetModel::find($petId);
                $idsVWA = (array)$petAux->very_weak_against;

                if ( count($idsVWA) )
                {
                    $key = array_search($this->id, $idsVWA);

                    if ( $key !== false )
                    {
                        if ( count($idsVWA) > 1 )
                        {
                            $last = $idsVWA[count($idsVWA)-1];
                            $idsVWA[count($idsVWA)-1] = $idsVWA[$key];
                            $idsVWA[$key] = $last;
                        }

                        array_pop($idsVWA);

                        $petAux->very_weak_against = implode(' ', $idsVWA);
                        $petAux->save();
                    }
                }
            }

        if ( ! empty($this->strong_against) )
            foreach (explode(' ', $this->strong_against) as $petId)
            {
                $petAux = PetModel::find($petId);
                $idsWA = (array)$petAux->weak_against;

                if ( count($idsWA) )
                {
                    $key = array_search($this->id, $idsWA);

                    if ( $key !== false )
                    {
                        if ( count($idsWA) > 1 )
                        {
                            $last = $idsWA[count($idsWA)-1];
                            $idsWA[count($idsWA)-1] = $idsWA[$key];
                            $idsWA[$key] = $last;
                        }

                        array_pop($idsWA);

                        $petAux->weak_against = implode(' ', $idsWA);
                        $petAux->save();
                    }
                }
            }

        if ( ! empty($this->very_weak_against) )
            foreach (explode(' ', $this->very_weak_against) as $petId)
            {
                $petAux = PetModel::find($petId);
                $idsVSA = (array)$petAux->very_strong_against;

                if ( count($idsVSA) )
                {
                    $key = array_search($this->id, $idsVSA);

                    if ( $key !== false )
                    {
                        if ( count($idsVSA) > 1 )
                        {
                            $last = $idsVSA[count($idsVSA)-1];
                            $idsVSA[count($idsVSA)-1] = $idsVSA[$key];
                            $idsVSA[$key] = $last;
                        }

                        array_pop($idsVSA);

                        $petAux->very_strong_against = implode(' ', $idsVSA);
                        $petAux->save();
                    }
                }
            }

        if ( ! empty($this->weak_against) )
            foreach (explode(' ', $this->weak_against) as $petId)
            {
                $petAux = PetModel::find($petId);
                $idsSA = (array)$petAux->strong_against;

                if ( count($idsSA) )
                {
                    $key = array_search($this->id, $idsSA);

                    if ( $key !== false )
                    {
                        if ( count($idsSA) > 1 )
                        {
                            $last = $idsSA[count($idsSA)-1];
                            $idsSA[count($idsSA)-1] = $idsSA[$key];
                            $idsSA[$key] = $last;
                        }

                        array_pop($idsSA);

                        $petAux->strong_against = implode(' ', $idsSA);
                        $petAux->save();
                    }
                }
            }
    }

    public function addVSPet (int $againstPetId, $field)
    {
        $pet = PetModel::find($againstPetId);
        if ( empty($pet->$field) )
        {
            $pet->$field = $this->id;
            $pet->save();
        }
        else
        {
            $ids = explode(' ', $pet->$field);
            if ( ! in_array($this->id, $ids) )
            {
                $pet->$field .= ' ' . $this->id;
                $pet->save();
            }
        }
    }

    private function getVSPets ( string $idPets ) : array
    {
        $result = [];
        if ( ! empty($idPets) )
        {
            $arr = explode(' ', $idPets);
            foreach ($arr as $id)
            {
                try
                {
                    $result[] = PetModel::find($id);
                }
                catch ( \Exception $e ) {}
            }
        }

        return $result;
    }
}
