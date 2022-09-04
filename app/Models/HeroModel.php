<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeroModel extends Model
{
    public $timestamps = false;

    protected $table = 'heroes';
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
    const RANGE_ORANGE_0 = 11;
    const RANGE_ORANGE_1 = 12;
    const RANGE_ORANGE_2 = 13;
    const RANGE_ORANGE_3 = 14;
    const RANGE_ORANGE_4 = 15;
    const RANGE_RED_0 = 16;
    const RANGE_RED_1 = 17;
    const RANGE_RED_2 = 18;

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

    public static function getRanges () : array
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
            self::RANGE_ORANGE_0 => __('general.orange_0'),
            self::RANGE_ORANGE_1 => __('general.orange_1'),
            self::RANGE_ORANGE_2 => __('general.orange_2'),
            self::RANGE_ORANGE_3 => __('general.orange_3'),
            self::RANGE_ORANGE_4 => __('general.orange_4'),
            self::RANGE_RED_0 => __('general.red_0'),
            self::RANGE_RED_1 => __('general.red_1'),
            self::RANGE_RED_2 => __('general.red_2'),
        ];
    }

    public function getRange ( $range )
    {
        $ranges = self::getRanges();

        return $ranges[$range];
    }

    public function getHeroesVSA () : array
    {
        return $this->getVSHeroes($this->very_strong_against ?? '');
    }

    public function getHeroesSA () : array
    {
        return $this->getVSHeroes($this->strong_against ?? '');
    }

    public function getHeroesVWA () : array
    {
        return $this->getVSHeroes($this->very_weak_against ?? '');
    }

    public function getHeroesWA () : array
    {
        return $this->getVSHeroes($this->weak_against ?? '');
    }

    public function removeVSHero ()
    {
        if ( ! empty($this->very_strong_against) )
            foreach (explode(' ', $this->very_strong_against) as $heroId)
            {
                $heroAux = HeroModel::find($heroId);
                $idsVWA = (array)$heroAux->very_weak_against;

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

                        $heroAux->very_weak_against = implode(' ', $idsVWA);
                        $heroAux->save();
                    }
                }
            }

        if ( ! empty($this->strong_against) )
            foreach (explode(' ', $this->strong_against) as $heroId)
            {
                $heroAux = HeroModel::find($heroId);
                $idsWA = (array)$heroAux->weak_against;

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

                        $heroAux->weak_against = implode(' ', $idsWA);
                        $heroAux->save();
                    }
                }
            }

        if ( ! empty($this->very_weak_against) )
            foreach (explode(' ', $this->very_weak_against) as $heroId)
            {
                $heroAux = HeroModel::find($heroId);
                $idsVSA = (array)$heroAux->very_strong_against;

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

                        $heroAux->very_strong_against = implode(' ', $idsVSA);
                        $heroAux->save();
                    }
                }
            }

        if ( ! empty($this->weak_against) )
            foreach (explode(' ', $this->weak_against) as $heroId)
            {
                $heroAux = HeroModel::find($heroId);
                $idsSA = (array)$heroAux->strong_against;

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

                        $heroAux->strong_against = implode(' ', $idsSA);
                        $heroAux->save();
                    }
                }
            }
    }

    public function addVSHero (int $againstHeroId, $field)
    {
        $hero = HeroModel::find($againstHeroId);
        if ( empty($hero->$field) )
        {
            $hero->$field = $this->id;
            $hero->save();
        }
        else
        {
            $ids = explode(' ', $hero->$field);
            if ( ! in_array($this->id, $ids) )
            {
                $hero->$field .= ' ' . $this->id;
                $hero->save();
            }
        }
    }

    private function getVSHeroes ( string $idHeroes ) : array
    {
        $result = [];
        if ( ! empty($idHeroes) )
        {
            $arr = explode(' ', $idHeroes);
            foreach ($arr as $id)
            {
                try
                {
                    $result[] = HeroModel::find($id);
                }
                catch ( \Exception $e ) {}
            }
        }

        return $result;
    }
}
