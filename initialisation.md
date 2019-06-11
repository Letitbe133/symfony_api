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

## how about populating our database ?

How do we create a table ? We could use **MySql CLI** or maybe **phpmyadmin**.

But Symfony provides a handy tool for that :

> symfony console make:entity

Now you just have to answer the wizard's questions to get things done

Go take a look at your database. Still empty, right ?

Now take a look at your **/src/Entity ** folder. Great no ?

## we still have to populate our databse

Let's do that !

> symfony console make:migration

Now you just created a migration but it was not executed. Check your database, nothing's changed.

Let's migrate NOW !

> symfony console doctrine:migrations:migrate

Check your database, now you should have a brand new table with the correct fields

Now have a look at your **/src/Migrations** folder : inside you should have a migration file. Have a look and you'll see you have some SQL request inside

## have a break, have a KitKat !

So far we :

- created a Symfony project
- configured our database connexion
- created our database
- created a table
- migrated it to the database

Now we should start working on building our API

## welcome to Hogwarts

**Spoil alert** : Some magical stuff ahead

> symfony console make:crud

On what **entity** the CRUD should be performed ? Since we have only one, it should be **Project**
