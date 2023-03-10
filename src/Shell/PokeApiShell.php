<?php
declare(strict_types=1);

namespace App\Shell;

use Cake\Console\ConsoleOptionParser;
use Cake\Console\Shell;
use Cake\Http\Client;

/**
 * PokeApi shell command.
 */
class PokeApiShell extends Shell
{

    /**
     * initialize function
     *
     * @return void
     */
    public function initialize(): void
    {
        $this->loadModel('Pokemons');
    }

    /**
     * main() method.
     *
     * @return void
     */
    public function main()
    {
        $this->verbose('Loading the 1st generation !');
        $this->_loadGeneration(1, 151);
        $this->verbose('Loading the 2nd generation !');
        $this->_loadGeneration(152, 251);
        $this->verbose('Loading the 3rd generation !');
        $this->_loadGeneration(252, 386);
        $this->verbose('Loading the 4th generation !');
        $this->_loadGeneration(387, 493);
        $this->verbose('Loading the 5th generation !');
        $this->_loadGeneration(494, 649);
        $this->verbose('Loading the 6th generation !');
        $this->_loadGeneration(650, 721);
        $this->verbose('Loading the 7th generation !');
        $this->_loadGeneration(722, 809);
        $this->verbose('Loading the 8th generation !');
        $this->_loadGeneration(810, 898);
    }

    /**
     * _loadGeneration function
     *
     * @param [type] $from start pokemon number
     * @param [type] $to end pokemon number
     * @return void
     */
    protected function _loadGeneration($from, $to)
    {
        for ($pokedexNumber = $from; $pokedexNumber <= $to; $pokedexNumber++) {
            $pokeApiData = $this->_getPokemonById($pokedexNumber);
            if (!$this->Pokemons->exists(['pokedex_number' => $pokedexNumber])) {
                $this->_createPokemon($pokeApiData);
            } else {
                $this->verbose("The pokemon {$pokedexNumber} already exist in database");
                $this->_updatePokemon($pokedexNumber, $pokeApiData);
            }
        }
    }

    /**
     * _getPokemonById function
     *
     * @param [type] $number pokemon identifier
     * @return array
     */
    protected function _getPokemonById($number)
    {
        $http = new Client();

        $response = $http->get("https://pokeapi.co/api/v2/pokemon/$number");

        if ($response->isOk()) {
            $pokemon = $response->getJson();
            $species_response = $http->get($pokemon['species']['url']);
            if ($species_response->isOk()) {
                $species = $species_response->getJson();
                switch ($species['generation']['name']) {
                    case 'generation-i':
                        $pokemon['generation'] = 1;
                        break;
                    case 'generation-ii':
                        $pokemon['generation'] = 2;
                        break;
                    case 'generation-iii':
                        $pokemon['generation'] = 3;
                        break;
                    case 'generation-iv':
                        $pokemon['generation'] = 4;
                        break;
                    case 'generation-v':
                        $pokemon['generation'] = 5;
                        break;
                    case 'generation-vi':
                        $pokemon['generation'] = 6;
                        break;
                    case 'generation-vii':
                        $pokemon['generation'] = 7;
                        break;
                    case 'generation-viii':
                        $pokemon['generation'] = 8;
                        break;
                    default:
                        $pokemon['generation'] = 0;
                }
            } else $pokemon['generation'] = 0;

            return $this->Pokemons->formatDataForSave($pokemon);
        } else {
            $this->verbose("Something wrong happen during Api call with Pokemon id : {$number}");
            return false;
        }
    }

    /**
     * Undocumented function
     *
     * @param array $pokemonFormatedData formated data
     * @return void
     */
    protected function _createPokemon($pokemonFormatedData)
    {
        $pokemon = $this->Pokemons->newEntity($pokemonFormatedData);
        if (!$this->Pokemons->save($pokemon)) {
            $this->verbose('Something wrong happen');
            \Cake\Log\Log::write('error', json_encode($pokemon->getErrors()));
        }
    }

    /**
     * Undocumented function
     *
     * @param int $pokedexNumber pokedex number
     * @param array $pokemonFormatedData formated data
     * @return void
     */
    protected function _updatePokemon($pokedexNumber, $pokemonFormatedData)
    {
        $pokemon = $this->Pokemons->find()
                ->where(['pokedex_number' => $pokedexNumber])
                ->contain([
                    'PokemonStats.Stats',
                    'PokemonTypes.Types',
                ])
                ->first();

        $pokemon = $this->Pokemons->patchEntity($pokemon, $pokemonFormatedData);
        if (!$this->Pokemons->save($pokemon)) {
            $this->verbose('Something wrong happen');
            \Cake\Log\Log::write('error', json_encode($pokemon->getErrors()));
        }
    }
}
