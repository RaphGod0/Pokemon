<?php

use Cake\ORM\TableRegistry;

$pokemons = TableRegistry::getTableLocator()->get('pokemons');

//Requete pour le poid moyen
$weights = $pokemons->find();
$weights->select(['poidsMoyen' => $weights->func()->avg('weight')])->where(['generation =' => 4]);

$poidsMoyen = $weights->first();

/**Recherche dans la base de donnée le nombre de pokémon de type fée par génération */
function fairy($generation)
{
    $pokemons = TableRegistry::getTableLocator()->get('pokemons');
    $fairy = $pokemons->find()->Join('pokemon_types')->Join('types');
    $fairy->select(['Nb_Type_Fee' => $fairy->func()->count('*')])
    ->where(['types.name =' => 'fairy'])
    ->andwhere(['pokemon_types.type_id = types.id'])
    ->andwhere(['pokemons.id = pokemon_types.pokemon_id'])
    ->andwhere(['pokemons.generation = ' => $generation]);

    return $fairy->first();
}

//choix des génération pour les types fée
$generation = [1, 3, 7];
$NombreTypeFee_1 = fairy($generation[0]);
$NombreTypeFee_3 = fairy($generation[1]);
$NombreTypeFee_7 = fairy($generation[2]);
$NombreTypeFee = $NombreTypeFee_1->Nb_Type_Fee + $NombreTypeFee_3->Nb_Type_Fee + $NombreTypeFee_7->Nb_Type_Fee;

//requete pour les 10 pokémons les plus rapide
$speed = $pokemons->find()->Join('pokemon_stats')->Join('stats');
$speed->select(['pokemon_stats.value', 'pokemons.name', 'pokemons.id', 'pokemons.default_front_sprite_url'])
->where(['stats.name =' => 'speed'])
->andwhere(['pokemon_stats.stat_id = stats.id'])
->andwhere(['pokemons.id = pokemon_stats.pokemon_id'])
->order(['pokemon_stats.value' => 'DESC'])
->limit(10);

$speeder = $speed->all();
?>
<br></br>
<h3>Poids Moyen</h3>
<table>
    <tr>
        <th>Génération</th>
        <th>Poids Moyen</th>
    </tr>
    <tr>
        <td>4</th>
        <td><?= h($poidsMoyen->poidsMoyen) ?></td>
    </tr>
</table>
<br></br>
<h3>Nombre de Pokemon de type Fée</h3>
<table>
    <tr>
        <th>Génération</th>
        <th>Nombre de type fée</th>
    </tr>

    <tr>
        <th><?= h($generation[0]) ?></th>
        <td><?= h($NombreTypeFee_1->Nb_Type_Fee) ?></td>
    </tr>
    <tr>
    <th><?= h($generation[1]) ?></th>
        <td><?= h($NombreTypeFee_3->Nb_Type_Fee) ?></td>
    </tr>
    <tr>
    <th><?= h($generation[2]) ?></th>
        <td><?= h($NombreTypeFee_7->Nb_Type_Fee) ?></td>
    </tr>
    <tr>
        <th>TOTAL</th>
        <th><?= h($NombreTypeFee) ?></th>
    </tr>
</table>
<br></br>
<h3>Meilleurs vitesse</h3>
<table>
    <tr>
        <th>Pokémon</th>
        <th>Front Sprite</th>
        <th>Vitesse</th>
    </tr>
    <?php foreach ($speeder as $pokemon) : ?>
    <tr>
        <td><?= $this->Html->link(__($pokemon->name), ['action' => 'view', $pokemon->id]) ?></td>
        <td> <img src=<?= h($pokemon->default_front_sprite_url) ?>></td>
        <td><?= h($pokemon->pokemon_stats['value']) ?></td>
    </tr>
    <?php endforeach; ?>
</table>
