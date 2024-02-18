<?php

namespace RobThree\HumanoID\Dictionaries;

use RobThree\HumanoID\Dictionaries\Space\CelestialBodies;
use RobThree\HumanoID\Dictionaries\Space\StarAdjectives;

class SpaceDictionary implements DictionaryInterface
{
    public static function dictionary(): array
    {
        return [
            "buzzwords" => static::buzzwords(),
            "colors" => StarAdjectives::colors(),
            "life-cycle" => StarAdjectives::lifeCycles(),
            "star-taxonomy" => StarAdjectives::taxonomy(),
            "celestialBodies" => static::celestialBodies(),
            "galaxies" => static::galaxies(),
        ];
    }

    public static function all(): array
    {
        return [
            ...static::buzzwords(),
            ...StarAdjectives::colors(),
            ...StarAdjectives::lifeCycles(),
            ...StarAdjectives::taxonomy(),
            ...static::celestialBodies(),
            ...static::galaxies(),
        ];
    }

    public static function buzzwords(): array
    {
        return [
            "Antimatter",
            "Aperture",
            "Apogee",
            "Asteroid",
            "Astronaut",
            "Atmosphere",
            "Binary",
            "Blackhole",
            "Bolometer",
            "Celestial",
            "Cluster",
            "Comet",
            "Constellation",
            "Cosmic",
            "Cosmonaut",
            "Cosmos",
            "Crater",
            "DarkMatter",
            "Density",
            "Discovery",
            "Docking",
            "Doppler",
            "Dust",
            "Eccentric",
            "Eclipse",
            "Elliptical",
            "Equinox",
            "Exoplanet",
            "Flare",
            "Galaxy",
            "Geospace",
            "Geostationary",
            "Gravity",
            "HeavenlyBody",
            "Hubble",
            "Inertia",
            "Intergalactic",
            "Interplanetary",
            "Interstellar",
            "Ionosphere",
            "Lens",
            "Lodestar",
            "Lunar",
            "Magnitude",
            "Mass",
            "Meteor",
            "Nebula",
            "Neutron",
            "Neutron",
            "Nova",
            "Orb",
            "Parallax",
            "Phase",
            "Probe",
            "Pulsar",
            "Quasar",
            "Radiation",
            "Revolve",
            "Ring",
            "Rings",
            "Rocket",
            "Satellite",
            "Singularity",
            "Solar",
            "Umbra",
            "Universe",
            "Vast",
            "Waning",
            "Waxing",
            "Wormhole",
            "Zenith"
        ];
    }

    public static function celestialBodies(): array
    {
        return [
            ...CelestialBodies::planets(),
            ...CelestialBodies::planetoids(),
        ];
    }

    public static function galaxies(): array
    {
        return [
            "Andromeda",
            "Backward",
            "Bode",
            "Cigar",
            "Hong",
            "MilkyWay",
            "Pinwheel",
            "Sombrero",
            "Tadpole"
        ];
    }
}