# Setup

## Create new API project

**using composer**

> composer create-project symfony/skeleton project_name
>
> **using Symfony CLI**
> symfony new --version=skeleton project_name

## Initialize Git

## Install Doctrine for DB management

> composer require doctrine

## Install make for elements creation management

> composer require make

## All commands to be executed

<!-- if CLI installed -->

> symfony console { command }

<!-- no CLI -->

> php bin/console { command }

# Let's get started !

## create a brand new database

> symfony console doctrine:database:create db_name

What happens ?

## configure your database connexion

> Take a look at your **.env** file

See ?

## now run the command to create your database again

> You should be good to go now !

## take a look at your database

> anybody here ? No... It's actually empty

## time to create table

Unleash the power of Symfony !

> symfony console doctrine:make:crud

What happens and what should we do next ?
Luckily Symfony tells you what to do !

## let's install what we need !

> composer require form validator twig-bundle security-csrf annotations

That should do the trick
