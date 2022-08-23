<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TitanModel extends Model
{
    public $timestamps = false;

    protected $table = 'titans';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'element',
        'very_strong_against',
        'strong_against',
        'very_weak_against',
        'weak_against',
    ];

    const ELEMENT_FIRE = 0;
    const ELEMENT_WATER = 1;
    const ELEMENT_EARTH = 2;

    public static function getElements()
    {
        return [
            self::ELEMENT_FIRE => ucfirst(__('titan.fire')),
            self::ELEMENT_WATER => ucfirst(__('titan.water')),
            self::ELEMENT_EARTH => ucfirst(__('titan.earth')),
        ];
    }

    public function getTitansVSA () : array
    {
        return $this->getVSTitans($this->very_strong_against ?? '');
    }

    public function getTitansSA () : array
    {
        return $this->getVSTitans($this->strong_against ?? '');
    }

    public function getTitansVWA () : array
    {
        return $this->getVSTitans($this->very_weak_against ?? '');
    }

    public function getTitansWA () : array
    {
        return $this->getVSTitans($this->weak_against ?? '');
    }

    public function removeVSTitan ()
    {
        if ( ! empty($this->very_strong_against) )
            foreach (explode(' ', $this->very_strong_against) as $titanId)
            {
                $titanAux = TitanModel::find($titanId);
                $idsVWA = (array)$titanAux->very_weak_against;

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

                        $titanAux->very_weak_against = implode(' ', $idsVWA);
                        $titanAux->save();
                    }
                }
            }

        if ( ! empty($this->strong_against) )
            foreach (explode(' ', $this->strong_against) as $titanId)
            {
                $titanAux = TitanModel::find($titanId);
                $idsWA = (array)$titanAux->weak_against;

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

                        $titanAux->weak_against = implode(' ', $idsWA);
                        $titanAux->save();
                    }
                }
            }

        if ( ! empty($this->very_weak_against) )
            foreach (explode(' ', $this->very_weak_against) as $titanId)
            {
                $titanAux = TitanModel::find($titanId);
                $idsVSA = (array)$titanAux->very_strong_against;

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

                        $titanAux->very_strong_against = implode(' ', $idsVSA);
                        $titanAux->save();
                    }
                }
            }

        if ( ! empty($this->weak_against) )
            foreach (explode(' ', $this->weak_against) as $titanId)
            {
                $titanAux = TitanModel::find($titanId);
                $idsSA = (array)$titanAux->strong_against;

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

                        $titanAux->strong_against = implode(' ', $idsSA);
                        $titanAux->save();
                    }
                }
            }
    }

    public function addVSTitan (int $againstTitanId, $field)
    {
        $titan = TitanModel::find($againstTitanId);
        if ( empty($titan->$field) )
        {
            $titan->$field = $this->id;
            $titan->save();
        }
        else
        {
            $ids = explode(' ', $titan->$field);
            if ( ! in_array($this->id, $ids) )
            {
                $titan->$field .= ' ' . $this->id;
                $titan->save();
            }
        }
    }

    private function getVSTitans ( string $idTitans ) : array
    {
        $result = [];
        if ( ! empty($idTitans) )
        {
            $arr = explode(' ', $idTitans);
            foreach ($arr as $id)
            {
                try
                {
                    $result[] = TitanModel::find($id);
                }
                catch ( \Exception $e ) {}
            }
        }

        return $result;
    }
}
