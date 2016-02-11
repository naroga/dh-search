Naroga's Search Bundle
======================

This is a search bundle, developed for exclusive usage of DistantJobHire.

Requirements
------------

This project makes use of some cool PHP 7.0 features (such as the Null Coalesce operator, Spaceship operator, scalar
 typehints, function return typehints and others). It also uses Symfony3, which means it shares its requirements.
 Additionally, you'll need the `php-curl` extension.

Installation
------------

To install this package, require it using composer:

    $ composer require naroga/search-bundle dev-master
    
Usage
-----

Indexing a document:

    $ php bin/console search:add <filename>
    File written successfully with ID <ID>
    
This indexes the file content.

Deleting a document:

    $ php bin/console search:delete <id>
    <#> entries deleted successfully.
    
This deletes an indexed document.

Searching for a document:
    
    $php bin/console search:search <expression>
    Found <#> results:
    ...
    
This searches for documents containing matches from the provided expression.

Unit testing
------------

Clone this repository, install the dependencies using `composer install` and run `phpunit`.

Switching Search Engines
------------------------

To switch to another Search Engine (let's use MyCustomSearchEngine as an example), you'll have to create a new bundle.

    $ php bin/console generate:bundle
    
Now, define this bundle as a parent of NarogaSearchBundle:

    #MyCustomSearchBundle.php
    class MyCustomSearchBundle extends Bundle
    {
        public function getParent()
        {
            return 'NarogaSearchBundle';
        }
    }
    
Now, create a new `MyCustomSearchEngine` class that implements `EngineInterface`:

    class MyCustomSearchEngine implements EngineInterface
    {
        public function add(string $name, string $content)
        {
            // TODO: Implement add() method.
        }
    
        public function search(string $expression) : array
        {
            // TODO: Implement search() method.
        }
    
        public function delete(string $id)
        {
            // TODO: Implement delete() method.
        }
    }

In your services.yml file, define your search engine as a service:

    services:
        mycustomengine.engine:
            class: My\Class\Path
            arguments: [ "here_come_your_dependencies" ]
            
Still in the `services` section, override the `naroga.search` service:

        naroga.search:
            class: Naroga\SearchBundle\Search\Search
            arguments: [ "@mycustomengine.engine" ] #pass your custom service here as a parameter.
            
Now you're good to go!

License
-------

This project is proprietary and thus cannot be used, copied, modified or distributed without explicit written 
consent from the owner (DistantJobHire).