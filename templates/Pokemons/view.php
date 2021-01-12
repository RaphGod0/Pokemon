<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Pokemon $pokemon
 */
?>
<aside class="column">
    <div class="side-nav">
        <h4 class="heading"><?= __('Actions') ?></h4>
        <?= $this->Form->postLink(__('🗑 Delete Pokemon'), ['action' => 'delete', $pokemon->id], ['confirm' => __('Are you sure you want to delete # {0}?', $pokemon->id), 'class' => 'side-nav-item']) ?>
        <?= $this->Html->link(__('📜 List Pokemons'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
    </div>
</aside>
<figure class="card card--<?= $pokemon->first_type ?>">
    <div class="card">

        <div class="c1">

            <div>
                <div class="card_image-container">
                    <div class="poke-sprite img">
                        <?= $this->Html->image($pokemon->main_sprite); ?>
                    </div>
                </div>
            </div>

            <div>

                <h1 class="card_name"><?= $pokemon->name ?></h1>

                <figcaption class="card_caption">


                    <h3 class="card_type <?= $pokemon->first_type ?>">
                        <?= $pokemon->first_type ?>
                    </h3>

                    <?php if ($pokemon->has_second_type) : ?>
                        <h3 class=" card_second_type <?= $pokemon->second_type ?>">
                            <?= $pokemon->second_type ?>
                        </h3>
                    <?php endif ?>

                    <div class="related">
                        <h4><?= __('Pokemon Stats') ?></h4>
                        <?php if (!empty($pokemon->pokemon_stats)) : ?>
                            <div class="table-responsive">
                                <table>
                                    <tr>

                                        <th><?= __('Stat Id') ?></th>


                                        <th><?= __('Value') ?></th>

                                    </tr>
                                    <?php foreach ($pokemon->pokemon_stats as $pokemonStats) : ?>
                                        <tr>

                                            <td><?= h($pokemonStats->stat_id) ?></td>
                                            <td><?= h($pokemonStats->value) ?></td>

                                        </tr>
                                    <?php endforeach; ?>
                                </table>
                            </div>
                        <?php endif; ?>
                    </div>
            </div>
        </div>
        <div class="card_image-container2">
            <div class="poke-sprite img">
                <?= $this->Html->image($pokemon->main_sprite); ?>
                <?= $this->Html->image($pokemon->back_sprite); ?>
                <?= $this->Html->image($pokemon->shiny_sprite); ?>
            </div>
        </div>
    </div>
    </div>
    <div class="column-responsive column-80">
        <div class="pokemons view content">
            <h3><?= h($pokemon->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($pokemon->name) ?></td>
                </tr>

                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($pokemon->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Height') ?></th>
                    <td><?= $this->Number->format($pokemon->height) ?></td>
                </tr>
                <tr>
                    <th><?= __('Weight') ?></th>
                    <td><?= $this->Number->format($pokemon->weight) ?></td>
                </tr>
                <tr>
                    <th><?= __('Pokedex Number') ?></th>
                    <td><?= $this->Number->format($pokemon->pokedex_number) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($pokemon->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($pokemon->modified) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Pokemon Stats') ?></h4>
                <?php if (!empty($pokemon->pokemon_stats)) : ?>
                    <div class="table-responsive">
                        <table>
                            <tr>
                                <th><?= __('Id') ?></th>
                                <th><?= __('Pokemon Id') ?></th>
                                <th><?= __('Stat Id') ?></th>
                                <th><?= __('Value') ?></th>
                                <th class="actions"><?= __('Actions') ?></th>
                            </tr>
                            <?php foreach ($pokemon->pokemon_stats as $pokemonStats) : ?>
                                <tr>
                                    <td><?= h($pokemonStats->id) ?></td>
                                    <td><?= h($pokemonStats->pokemon_id) ?></td>
                                    <td><?= h($pokemonStats->stat_id) ?></td>
                                    <td><?= h($pokemonStats->value) ?></td>
                                    <td class="actions">
                                        <?= $this->Html->link(__('View'), ['controller' => 'PokemonStats', 'action' => 'view', $pokemonStats->id]) ?>
                                        <?= $this->Html->link(__('Edit'), ['controller' => 'PokemonStats', 'action' => 'edit', $pokemonStats->id]) ?>
                                        <?= $this->Form->postLink(__('Delete'), ['controller' => 'PokemonStats', 'action' => 'delete', $pokemonStats->id], ['confirm' => __('Are you sure you want to delete # {0}?', $pokemonStats->id)]) ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </table>

                    </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Pokemon Types') ?></h4>
                <?php if (!empty($pokemon->pokemon_types)) : ?>
                    <div class="table-responsive">
                        <table>
                            <tr>
                                <th><?= __('Id') ?></th>
                                <th><?= __('Pokemon Id') ?></th>
                                <th><?= __('Type Id') ?></th>
                                <th><?= __('Created') ?></th>
                                <th><?= __('Modified') ?></th>
                                <th class="actions"><?= __('Actions') ?></th>
                            </tr>
                            <?php foreach ($pokemon->pokemon_types as $pokemonTypes) : ?>
                                <tr>
                                    <td><?= h($pokemonTypes->id) ?></td>
                                    <td><?= h($pokemonTypes->pokemon_id) ?></td>
                                    <td><?= h($pokemonTypes->type_id) ?></td>
                                    <td><?= h($pokemonTypes->created) ?></td>
                                    <td><?= h($pokemonTypes->modified) ?></td>
                                    <td class="actions">
                                        <?= $this->Html->link(__('View'), ['controller' => 'PokemonTypes', 'action' => 'view', $pokemonTypes->id]) ?>
                                        <?= $this->Html->link(__('Edit'), ['controller' => 'PokemonTypes', 'action' => 'edit', $pokemonTypes->id]) ?>
                                        <?= $this->Form->postLink(__('Delete'), ['controller' => 'PokemonTypes', 'action' => 'delete', $pokemonTypes->id], ['confirm' => __('Are you sure you want to delete # {0}?', $pokemonTypes->id)]) ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <style>
        .card {
            display: inline-block;
            width: 1080px;
            padding: 1em;
            border-radius: 15px;
            margin: 10px;
            background: #ddd;
            text-align: left;
            box-shadow: 0px 5px 20px -10px #111111;
            position: relative;
            transition: 0.4s;
        }

        .card_caption {
            background-color: rgba(255, 255, 255, 0.65);
            padding: 1em;
            position: relative;
            border-radius: 0 0 3px 3px;
        }

        .card_image-container {

            text-align: center;
            padding: 15em 1em 0;
            border-radius: 3px 3px 0 0;

        }

        .card_type {
            position: absolute;
            top: 0;
            right: 1em;
            transform: translateY(-50%);
            color: #ffffff;
            font-family: "Open Sans Condensed", "Open Sans", helvetica, sans-serif;
            letter-spacing: 0.1em;
            padding: 0.25em;
            line-height: 1;
            border-radius: 2px;
            background: #bbbbbb;
        }

        .card_second_type {
            position: absolute;
            top: 0;
            left: 2em;
            transform: translate(-50%, -50%);
            color: #ffffff;
            font-family: "Open Sans Condensed", "Open Sans", helvetica, sans-serif;
            letter-spacing: 0.1em;
            padding: 0.25em;
            line-height: 1;
            border-radius: 2px;
            background: #bbbbbb;
        }

        .card_label {
            font-size: 10px;
            text-transform: uppercase;
            font-weight: 400;
            display: block;
            margin-bottom: 3px;
        }

        .card_name {
            font-family: "Pokemon", "Open Sans Condensed", "Open Sans", helvetica, sans-serif;
            text-align: center;
            font-size: 3em;
            font-weight: 700;
            letter-spacing: 0.08em;
        }

        .card_stats {
            margin: 1em 0;
            width: 100%;
        }

        .card_stats th {
            font-family: "Open Sans Condensed", "Open Sans", helvetica, sans-serif;
            text-align: right;
            font-weight: 300;
        }

        .card_stats th,
        .card_stats td {
            width: 50%;
            padding: 0.25em 0.5em 0;
        }

        .card_abilities {
            display: flex;
            justify-content: space-between;
        }

        .card_ability {
            margin-top: 1em;
            flex: 1 0;
        }

        .card--normal,
        .card .normal {
            background: linear-gradient(110deg, #fdbb2d 0%, #3a1c71 100%);
            box-shadow: 0px 5px 20px -10px #3a1c71;
        }

        .card--normal .card__type,
        .card .normal .card__type {
            background-color: #c08a53;
        }

        .card--water,
        .card .water {
            background: linear-gradient(120deg, #1cb5e0 0%, #000851 100%);
            box-shadow: 0px 5px 20px -10px #000851;
        }

        .card--water .card__type,
        .card .water .card__type {
            background-color: #1cb5e0;
        }

        .card--electric,
        .card .electric {
            background: linear-gradient(90deg, #ffde00 34%, #e8ff99 83%);
        }

        .card--electric .card__type,
        .card .electric .card__type {
            background-color: #000;
        }

        .card--fire,
        .card .fire {
            background: linear-gradient(0deg, #c71800 10%, #fcc245 100%);
        }

        .card--fire .card__type,
        .card .fire .card__type {
            background-color: #c71800;
        }

        .card--psychic,
        .card .psychic {
            background: linear-gradient(140deg, #ffa7f9 0%, #ff2cc3 39%, #ffe3a7 100%);
        }

        .card--psychic .card__type,
        .card .psychic .card__type {
            background: #ff2cc3;
        }

        .card--dark,
        .card .dark {
            background: linear-gradient(20deg, #191919 0%, #100b32 33%, #5c0249 100%);
        }

        .card--dark .card__type,
        .card .dark .card__type {
            background: #5c0249;
        }

        .card--grass,
        .card .grass {
            background: linear-gradient(140deg, #c4da3d 0%, #6e7f0e 69%, #275009 100%);
        }

        .card--grass .card__type,
        .card .grass .card__type {
            background: #6e7f0e;
        }

        .card--ice,
        .card .ice {
            background: linear-gradient(230deg, #caeaf6 0%, #a0eaf1 46%, #6fb8eb 100%);
        }

        .card--ice .card__type,
        .card .ice .card__type {
            background: #6fb8eb;
        }

        .card--fairy,
        .card .fairy {
            background: linear-gradient(45deg, #ffe6f0 0%, #ffc5e0 34%, #ffa6b9 71%, #ff8a95 100%);
        }

        .card--fairy .card__type,
        .card .fairy .card__type {
            background: #ff8a95;
        }

        .card__image-container2 {
            text-align: center;
            padding: 1em 1em 0;
            border-radius: 3px 3px 0 0;
        }

        .c1 {
            padding: 3em 1em 0;
            display: grid;
            grid-template-columns: 1fr 1fr;
            background: #ddd;
            margin-left: auto;
            margin-right: auto;
        }

        .img {
            min-width: 180px;
            min-height: 180px;
        }

        .poke-sprite img {
            min-width: 300px;
            min-height: 300px;
        }
    </style>