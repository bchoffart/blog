<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Contact;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for($i = 0; $i <= 5; $i++) {
            $article = new Article();
            $article->setName("Article #" . $i);
            $article->setContent("Lorem ipsum");
            $article->setSlug("article-" . $i);
            $manager->persist($article);

            $contact = new Contact();
            $contact->setEmail("user" . $i . "@gmail.com");
            $contact->setMessage("Test message");
            $contact->setNewsletter("Test Newsletter");
            $contact->setNom("Testeur");
            $contact->setPrenom("Manuel");
            $contact->setSubject("Sujet " . $i);
            $manager->persist($contact);
        }

        $manager->flush();
    }
}
