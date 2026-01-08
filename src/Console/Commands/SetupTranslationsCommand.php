<?php

namespace Lkt\WebItems\Console\Commands;

use Lkt\Translations\Enums\TranslationType;
use Lkt\Translations\Instances\LktTranslation;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SetupTranslationsCommand extends Command
{
    protected static $defaultName = 'lkt:web-items:setup:i18n';

    protected function configure()
    {
        $this
            // the short description shown while running "php bin/console list"
            ->setDescription('Automatically generates all default translations')

            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp('')
        ;
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $parent = LktTranslation::createIfMissing('webItems', TranslationType::Many, []);
        $parentId = $parent->getId();
        LktTranslation::createIfMissing('user', TranslationType::Text, [
            'es' => 'Usuarios',
            'en' => 'Users',
        ], $parentId);
        LktTranslation::createIfMissing('user-role', TranslationType::Text, [
            'es' => 'Roles de usuarios',
            'en' => 'User Roles',
        ], $parentId);
        LktTranslation::createIfMissing('menu', TranslationType::Text, [
            'es' => 'Menus',
            'en' => 'Menus',
        ], $parentId);
        LktTranslation::createIfMissing('menu-entry', TranslationType::Text, [
            'es' => 'Entradas de Menus',
            'en' => 'Menu Entries',
        ], $parentId);
        LktTranslation::createIfMissing('i18n', TranslationType::Text, [
            'es' => 'Traducciones',
            'en' => 'Translations',
        ], $parentId);
        LktTranslation::createIfMissing('many-i18n', TranslationType::Text, [
            'es' => 'Diccionario',
            'en' => 'Dictionary',
        ], $parentId);

        return 1;
    }
}