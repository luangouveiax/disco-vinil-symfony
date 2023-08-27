<?php

namespace App\Factory;

use App\Entity\DiscoVinil;
use App\Repository\DiscoVinilRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<DiscoVinil>
 *
 * @method        DiscoVinil|Proxy create(array|callable $attributes = [])
 * @method static DiscoVinil|Proxy createOne(array $attributes = [])
 * @method static DiscoVinil|Proxy find(object|array|mixed $criteria)
 * @method static DiscoVinil|Proxy findOrCreate(array $attributes)
 * @method static DiscoVinil|Proxy first(string $sortedField = 'id')
 * @method static DiscoVinil|Proxy last(string $sortedField = 'id')
 * @method static DiscoVinil|Proxy random(array $attributes = [])
 * @method static DiscoVinil|Proxy randomOrCreate(array $attributes = [])
 * @method static DiscoVinilRepository|RepositoryProxy repository()
 * @method static DiscoVinil[]|Proxy[] all()
 * @method static DiscoVinil[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static DiscoVinil[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static DiscoVinil[]|Proxy[] findBy(array $attributes)
 * @method static DiscoVinil[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static DiscoVinil[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class DiscoVinilFactory extends ModelFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function getDefaults(): array
    {
        return [
            'contaFaixas' => self::faker()->numberBetween(5, 20),
            'descricao' => self::faker()->paragraph(),
            'genero' => self::faker()->randomElement(['MPB', 'Rock']),
            'titulo' => self::faker()->words(5, true),
            'votos' => self::faker()->numberBetween(-50, 50),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(DiscoVinil $discoVinil): void {})
        ;
    }

    protected static function getClass(): string
    {
        return DiscoVinil::class;
    }
}
