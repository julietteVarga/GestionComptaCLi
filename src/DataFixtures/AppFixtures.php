<?php

namespace App\DataFixtures;

use App\Entity\Adresse;
use App\Entity\CommentaireConsultant;
use App\Entity\Consultant;
use App\Entity\Facture;
use App\Entity\LigneFacture;
use App\Entity\RendezVous;
use App\Entity\Role;
use App\Entity\Service;
use App\Entity\TypeDePaiement;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PropertyInfo\Type;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private UserPasswordEncoderInterface $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        //--------------------------------------------------------------------------------------
        //Création des Roles
        //--------------------------------------------------------------------------------------
        $role1 = new Role();
        $role1->setNom("ROLE_ADMIN");
        $manager->persist($role1);

        $role2 = new Role();
        $role2->setNom("ROLE_USER");
        $manager->persist($role2);

        $role3 = new Role();
        $role3->setNom("ROLE_CONSULTANT");
        $manager->persist($role3);

        //-------------------------------------------
        //Création des User
        //-------------------------------------------
        $user1 = new User();
        $user1->setEmail("contact@energie-denis-sanchez.fr");
        $user1->setUsername("admin");
        $user1->setNom("Energie");
        $user1->setPrenom("Denis Sanchez");
        $user1->setTel("853478254");
        $user1->setRoles([$role3->getNom(),$role1->getNom()]);

        //Encodage du password
        $plainPassword = "123456";
        $encoded = $this->encoder->encodePassword($user1, $plainPassword);
        $user1->setPassword($encoded);
        $manager->persist($user1);

        $user2 = new User();
        $user2->setEmail("dsanchez@eni-ecole.fr");
        $user2->setUsername("denis");
        $user2->setNom("Sanchez");
        $user2->setPrenom("Denis");
        $user2->setTel("853478254");
        $user1->setRoles([$role3->getNom(),$role1->getNom()]);
        $plainPassword = "123456";
        $encoded = $this->encoder->encodePassword($user2, $plainPassword);
        $user2->setPassword($encoded);
        $manager->persist($user2);

        $user3 = new User();
        $user3->setEmail("momo@eni-ecole.fr");
        $user3->setUsername("Momo");
        $user3->setNom("Zahafi");
        $user3->setPrenom("Mohamed");
        $user3->setTel("853478254");
        $user1->setRoles([$role1->getNom()]);
        $plainPassword = "123456";
        $encoded = $this->encoder->encodePassword($user3, $plainPassword);
        $user3->setPassword($encoded);
        $manager->persist($user3);

        $user4 = new User();
        $user4->setEmail("juju@eni-ecole.fr");
        $user4->setUsername("Juju");
        $user4->setNom("Varga");
        $user4->setPrenom("Juliette");
        $user4->setTel("853478254");
        $user4->setRoles([$role1->getNom()]);
        $plainPassword = "123456";
        $encoded = $this->encoder->encodePassword($user4, $plainPassword);
        $user4->setPassword($encoded);
        $manager->persist($user4);


        $user5 = new User();
        $user5->setEmail("toto@eni-ecole.fr");
        $user5->setUsername("toto");
        $user5->setNom("Toto");
        $user5->setPrenom("Prenom toto");
        $user5->setTel("853478254");
        $user5->setRoles([$role1->getNom()]);
        $plainPassword = "123456";
        $encoded = $this->encoder->encodePassword($user5, $plainPassword);
        $user5->setPassword($encoded);
        $manager->persist($user5);

        //--------------------------------------------------------------------------------------
        //Création des TypeDePaiements
        //--------------------------------------------------------------------------------------

        $type1 = new TypeDePaiement();
        $type1->setLibelle("Chèque");
        $manager->persist($type1);

        $type2 = new TypeDePaiement();
        $type2->setLibelle("Espèce");
        $manager->persist($type2);

        $type3 = new TypeDePaiement();
        $type3->setLibelle("Paypal");
        $manager->persist($type3);


        $type4 = new TypeDePaiement();
        $type4->setLibelle("Virement bancaire");
        $manager->persist($type4);


        $type5 = new TypeDePaiement();
        $type5->setLibelle("Carte bancaire");
        $manager->persist($type5);

        //--------------------------------------------------------------------------------------
        //Création des Services
        //--------------------------------------------------------------------------------------
        $service1 = new Service();
        $service1->setLibelle("Nettoyage lieu de vie");
        $manager->persist($service1);

        $service2 = new Service();
        $service2->setLibelle("Soin Reiki");
        $manager->persist($service2);

        $service3 = new Service();
        $service3->setLibelle("Passeur d'âme");
        $manager->persist($service3);

        $service4 = new Service();
        $service4->setLibelle("Soin à distance");
        $manager->persist($service4);

        $service5 = new Service();
        $service5->setLibelle("Soin");
        $manager->persist($service5);

        $service6 = new Service();
        $service6->setLibelle("Soin sur les animaux");
        $manager->persist($service6);

        $service7 = new Service();
        $service7->setLibelle("Formation");
        $manager->persist($service7);

        $service8 = new Service();
        $service8->setLibelle("Atelier");
        $manager->persist($service8);

        $service9 = new Service();
        $service9->setLibelle("Formation en ligne");
        $manager->persist($service9);



        //--------------------------------------------------------------------------------------
        //Création des Adresses
        //--------------------------------------------------------------------------------------

        $adresse1 = new Adresse();
        $adresse1->setRue("9 rue Julles Rieffel");
        $adresse1->setCp("35000");
        $adresse1->setVille("Rennes");
        $adresse1->setPays("France");
        $manager->persist($adresse1);


        $adresse2 = new Adresse();
        $adresse2->setRue("9 allée d'enfance 35820 ");
        $adresse2->setCp("35310");
        $adresse2->setVille("La Janais");
        $adresse2->setPays("France");
        $manager->persist($adresse2);


        $adresse3 = new Adresse();
        $adresse3->setRue("rue de la fontaine");
        $adresse3->setCp("35350");
        $adresse3->setVille("Cesson sévigne");
        $adresse3->setPays("France");
        $manager->persist($adresse3);


        //--------------------------------------------------------------------------------------
        // Création des Consultant
        //--------------------------------------------------------------------------------------

        $consultant1=new Consultant();
        $consultant1->setNom("Cruise");
        $consultant1->setPrenom("Tom");
        $consultant1->setTel("064582354");
        $consultant1->setAdresse($adresse1);
        $consultant1->setEmail("tomcuise@gmail.com");
        $consultant1->setDateNaissance(new \DateTime("03-07-1962"));
        $consultant1->setHeureNaissance("00:00");
        $consultant1->setVilleNaissance("Syracuse");
        $consultant1->setPaysNaissance("USA");
        $consultant1->setSex("Masculin");
        $consultant1->setUsername("tommy");
        $plainPassword = "123456";
        $encoded = $this->encoder->encodePassword($consultant1, $plainPassword);
        $consultant1->setPassword($encoded);
        $consultant1->setRoles([$role3->getNom()]);
        $consultant1->setDateCreation(new \DateTime('now'));
        $manager->persist($consultant1);


        $consultant2=new Consultant();
        $consultant2->setNom("Dupont");
        $consultant2->setPrenom("Pierre");
        $consultant2->setTel("0745235665");
        $consultant2->setAdresse($adresse2);
        $consultant2->setEmail("pierredupont@gmail.com");
        $consultant2->setDateNaissance(new \DateTime("03-07-1970"));
        $consultant2->setHeureNaissance("13:52");
        $consultant2->setVilleNaissance("Rennes");
        $consultant2->setPaysNaissance("France");
        $consultant2->setSex("Masculin");
        $consultant2->setUsername("pierrot");
        $plainPassword = "secret";
        $encoded = $this->encoder->encodePassword($consultant2, $plainPassword);
        $consultant2->setPassword($encoded);
        $consultant2->setRoles([$role3->getNom()]);
        $consultant2->setDateCreation(new \DateTime('now'));
        $manager->persist($consultant2);


        $consultant3 = new Consultant();
        $consultant3->setNom("Princesse");
        $consultant3->setPrenom("Charline");
        $consultant3->setTel("064752564");
        $consultant3->setAdresse($adresse3);
        $consultant3->setEmail("p.charle@gmail.com");
        $consultant3->setDateNaissance(new \DateTime("14-10-1991"));
        $consultant3->setHeureNaissance("7:20");
        $consultant3->setVilleNaissance("Paris");
        $consultant3->setPaysNaissance("France");
        $consultant3->setSex("Feminin");
        $consultant3->setUsername("charline");
        $plainPassword = "123456";
        $encoded = $this->encoder->encodePassword($consultant3, $plainPassword);
        $consultant3->setPassword($encoded);
        $consultant3->setRoles([$role3->getNom()]);
        $consultant3->setDateCreation(new \DateTime('now'));
        $manager->persist($consultant3);

        $adresse4 = new Adresse();
        $adresse4->setRue("6 allée de la bergère");
        $adresse4->setCp("85550");
        $adresse4->setVille("LA BARRE DE MONTS");
        $adresse4->setPays("France");
        $manager->persist($adresse4);

        $consultant4 = new Consultant();
        $consultant4->setNom("Boissonnot");
        $consultant4->setPrenom("Anais");
        $consultant4->setTel(null);
        $consultant4->setAdresse($adresse4);
        $consultant4->setEmail(null);
        $consultant4->setDateNaissance(null);
        $consultant4->setHeureNaissance(null);
        $consultant4->setVilleNaissance(null);
        $consultant4->setPaysNaissance(null);
        $consultant4->setSex("Feminin");
        $consultant4->setUsername("anaisBoissonnot");
        $plainPassword = "123456";
        $encoded = $this->encoder->encodePassword($consultant4, $plainPassword);
        $consultant4->setPassword($encoded);
        $consultant4->setRoles([$role3->getNom()]);
        $consultant4->setDateCreation(new \DateTime('now'));
        $manager->persist($consultant4);

        $adresse5 = new Adresse();
        $adresse5->setRue("28 rue des platanes");
        $adresse5->setCp("91700");
        $adresse5->setVille("Ste Genevieve des Bois");
        $adresse5->setPays("France");
        $manager->persist($adresse5);

        $consultant5 = new Consultant();
        $consultant5->setNom("Ibanez");
        $consultant5->setPrenom("Anne");
        $consultant5->setTel(null);
        $consultant5->setAdresse($adresse5);
        $consultant5->setEmail(null);
        $consultant5->setDateNaissance(null);
        $consultant5->setHeureNaissance(null);
        $consultant5->setVilleNaissance(null);
        $consultant5->setPaysNaissance(null);
        $consultant5->setSex("Feminin");
        $consultant5->setUsername("anneIbanez");
        $plainPassword = "123456";
        $encoded = $this->encoder->encodePassword($consultant5, $plainPassword);
        $consultant5->setPassword($encoded);
        $consultant5->setRoles([$role3->getNom()]);
        $consultant5->setDateCreation(new \DateTime('now'));
        $manager->persist($consultant5);


        $adresse6 = new Adresse();
        $adresse6->setRue("Chez Michel Aubert 6 rue de la cailliere");
        $adresse6->setCp("44340");
        $adresse6->setVille("Bouguenais");
        $adresse6->setPays("France");
        $manager->persist($adresse6);

        $consultant6 = new Consultant();
        $consultant6->setNom("Association");
        $consultant6->setPrenom("Cles de l'harmonie");
        $consultant6->setTel(null);
        $consultant6->setAdresse($adresse6);
        $consultant6->setEmail(null);
        $consultant6->setDateNaissance(null);
        $consultant6->setHeureNaissance(null);
        $consultant6->setVilleNaissance(null);
        $consultant6->setPaysNaissance(null);
        $consultant6->setSex("Feminin");
        $consultant6->setUsername("associationClesDeLHarmonie");
        $plainPassword = "123456";
        $encoded = $this->encoder->encodePassword($consultant6, $plainPassword);
        $consultant6->setPassword($encoded);
        $consultant6->setRoles([$role3->getNom()]);
        $consultant6->setDateCreation(new \DateTime('now'));
        $manager->persist($consultant6);

        $adresse7 = new Adresse();
        $adresse7->setRue("45 les rivieres");
        $adresse7->setCp("44290");
        $adresse7->setVille("Guemene Penfao");
        $adresse7->setPays("France");
        $manager->persist($adresse7);

        $consultant7 = new Consultant();
        $consultant7->setNom("Audureau");
        $consultant7->setPrenom("Patricia");
        $consultant7->setTel(null);
        $consultant7->setAdresse($adresse7);
        $consultant7->setEmail(null);
        $consultant7->setDateNaissance(null);
        $consultant7->setHeureNaissance(null);
        $consultant7->setVilleNaissance(null);
        $consultant7->setPaysNaissance(null);
        $consultant7->setSex("Feminin");
        $consultant7->setUsername("audureauPatricia");
        $plainPassword = "123456";
        $encoded = $this->encoder->encodePassword($consultant7, $plainPassword);
        $consultant7->setPassword($encoded);
        $consultant7->setRoles([$role3->getNom()]);
        $consultant7->setDateCreation(new \DateTime('now'));
        $manager->persist($consultant7);

        $adresse7a = new Adresse();
        $adresse7a->setRue("9 rue des macareux");
        $adresse7a->setCP("44810");
        $adresse7a->setVille("Heric");
        $adresse7a->setPays("France");
        $manager->persist($adresse7a);

        $consultant7a = new Consultant();
        $consultant7a->setNom("Boissel");
        $consultant7a->setPrenom("Brigitte");
        $consultant7a->setTel(null);
        $consultant7a->setAdresse($adresse7a);
        $consultant7a->setEmail(null);
        $consultant7a->setDateNaissance(null);
        $consultant7a->setHeureNaissance(null);
        $consultant7a->setVilleNaissance(null);
        $consultant7a->setPaysNaissance(null);
        $consultant7a->setSex("Feminin");
        $consultant7a->setUsername("brigitteBoissel");
        $plainPassword = "123456";
        $encoded = $this->encoder->encodePassword($consultant7a, $plainPassword);
        $consultant7a->setPassword($encoded);
        $consultant7a->setRoles([$role3->getNom()]);
        $consultant7a->setDateCreation(new \DateTime('now'));
        $manager->persist($consultant7a);

        $adresse8 = new Adresse();
        $adresse8->setRue("")->setCP("")->setVille("")->setPays("France");
        $manager->persist($adresse8);
        $consultant8 = new Consultant();
        $consultant8->setNom("Burgaud");
        $consultant8->setPrenom("Sebastien");
        $consultant8->setTel(null);
        $consultant8->setAdresse($adresse8);
        $consultant8->setEmail(null);
        $consultant8->setDateNaissance(null);
        $consultant8->setHeureNaissance(null);
        $consultant8->setVilleNaissance(null);
        $consultant8->setPaysNaissance(null);
        $consultant8->setSex("Masculin");
        $consultant8->setUsername("sebastienBurgaud");
        $plainPassword = "123456";
        $encoded = $this->encoder->encodePassword($consultant8, $plainPassword);
        $consultant8->setPassword($encoded);
        $consultant8->setRoles([$role3->getNom()]);
        $consultant8->setDateCreation(new \DateTime('now'));
        $manager->persist($consultant8);

        $adresse9 = new Adresse();
        $adresse9->setRue("13 rue Georges Bizet");
        $adresse9->setCP("44330");
        $adresse9->setVille("Vallet");
        $adresse9->setPays("France");
        $manager->persist($adresse9);

        $consultant9 = new Consultant();
        $consultant9->setNom("Catteau");
        $consultant9->setPrenom("Veronique");
        $consultant9->setTel(null);
        $consultant9->setAdresse($adresse9);
        $consultant9->setEmail(null);
        $consultant9->setDateNaissance(null);
        $consultant9->setHeureNaissance(null);
        $consultant9->setVilleNaissance(null);
        $consultant9->setPaysNaissance(null);
        $consultant9->setSex("Feminin");
        $consultant9->setUsername("veroniqueCatteau");
        $plainPassword = "123456";
        $encoded = $this->encoder->encodePassword($consultant9, $plainPassword);
        $consultant9->setPassword($encoded);
        $consultant9->setRoles([$role3->getNom()]);
        $consultant9->setDateCreation(new \DateTime('now'));
        $manager->persist($consultant9);

        $adresse10 = new Adresse();
        $adresse10->setRue("24 rue des Iris");
        $adresse10->setCP("44190");
        $adresse10->setVille("Getigne");
        $adresse10->setPays("France");
        $manager->persist($adresse10);

        $consultant10 = new Consultant();
        $consultant10->setNom("Choblet");
        $consultant10->setPrenom("Thierry");
        $consultant10->setTel(null);
        $consultant10->setAdresse($adresse10);
        $consultant10->setEmail(null);
        $consultant10->setDateNaissance(null);
        $consultant10->setHeureNaissance(null);
        $consultant10->setVilleNaissance(null);
        $consultant10->setPaysNaissance(null);
        $consultant10->setSex("Masculin");
        $consultant10->setUsername("thierryChoblet");
        $plainPassword = "123456";
        $encoded = $this->encoder->encodePassword($consultant10, $plainPassword);
        $consultant10->setPassword($encoded);
        $consultant10->setRoles([$role3->getNom()]);
        $consultant10->setDateCreation(new \DateTime('now'));
        $manager->persist($consultant10);

        $adresse11 = new Adresse();
        $adresse11->setRue("");
        $adresse11->setCP("");
        $adresse11->setVille("");
        $adresse11->setPays("France");
        $manager->persist($adresse11);

        $consultant11 = new Consultant();
        $consultant11->setNom("Mahu");
        $consultant11->setPrenom("Christine");
        $consultant11->setTel(null);
        $consultant11->setAdresse($adresse11);
        $consultant11->setEmail("christine.mahu83@gmail.com");
        $consultant11->setDateNaissance(null);
        $consultant11->setHeureNaissance(null);
        $consultant11->setVilleNaissance(null);
        $consultant11->setPaysNaissance(null);
        $consultant11->setSex("Feminin");
        $consultant11->setUsername("christineMahu");
        $plainPassword = "123456";
        $encoded = $this->encoder->encodePassword($consultant11, $plainPassword);
        $consultant11->setPassword($encoded);
        $consultant11->setRoles([$role3->getNom()]);
        $consultant11->setDateCreation(new \DateTime('now'));
        $manager->persist($consultant11);

        $adresse12 = new Adresse();
        $adresse12->setRue("9 La Perdriais");
        $adresse12->setCP("44590");
        $adresse12->setVille("Sion les Mines");
        $adresse12->setPays("France");
        $manager->persist($adresse12);

        $consultant12 = new Consultant();
        $consultant12->setNom("Clement-Sevinc");
        $consultant12->setPrenom("Sandrine");
        $consultant12->setTel(null);
        $consultant12->setAdresse($adresse12);
        $consultant12->setEmail(null);
        $consultant12->setDateNaissance(null);
        $consultant12->setHeureNaissance(null);
        $consultant12->setVilleNaissance(null);
        $consultant12->setPaysNaissance(null);
        $consultant12->setSex("Feminin");
        $consultant12->setUsername("sandrineClementSevinc");
        $plainPassword = "123456";
        $encoded = $this->encoder->encodePassword($consultant12, $plainPassword);
        $consultant12->setPassword($encoded);
        $consultant12->setRoles([$role3->getNom()]);
        $consultant12->setDateCreation(new \DateTime('now'));
        $manager->persist($consultant12);

        $adresse13 = new Adresse();
        $adresse13->setRue("18 chemin du dervenn");
        $adresse13->setCP("44470");
        $adresse13->setVille("Thouaré-sur-Loire");
        $adresse13->setPays("France");
        $manager->persist($adresse13);

        $consultant13 = new Consultant();
        $consultant13->setNom("Richet");
        $consultant13->setPrenom("Coraline");
        $consultant13->setTel(null);
        $consultant13->setAdresse($adresse13);
        $consultant13->setEmail(null);
        $consultant13->setDateNaissance(null);
        $consultant13->setHeureNaissance(null);
        $consultant13->setVilleNaissance(null);
        $consultant13->setPaysNaissance(null);
        $consultant13->setSex("Feminin");
        $consultant13->setUsername("coralineRichet");
        $plainPassword = "123456";
        $encoded = $this->encoder->encodePassword($consultant13, $plainPassword);
        $consultant13->setPassword($encoded);
        $consultant13->setRoles([$role3->getNom()]);
        $consultant13->setDateCreation(new \DateTime('now'));
        $manager->persist($consultant13);

        $adresse14 = new Adresse();
        $adresse14->setRue("La salmonais");
        $adresse14->setCP("44360");
        $adresse14->setVille("Cordemais");
        $adresse14->setPays("France");
        $manager->persist($adresse14);

        $consultant14 = new Consultant();
        $consultant14->setNom("Hervo");
        $consultant14->setPrenom("Corinne");
        $consultant14->setTel(null);
        $consultant14->setAdresse($adresse14);
        $consultant14->setEmail(null);
        $consultant14->setDateNaissance(null);
        $consultant14->setHeureNaissance(null);
        $consultant14->setVilleNaissance(null);
        $consultant14->setPaysNaissance(null);
        $consultant14->setSex("Feminin");
        $consultant14->setUsername("corinneHervo");
        $plainPassword = "123456";
        $encoded = $this->encoder->encodePassword($consultant14, $plainPassword);
        $consultant14->setPassword($encoded);
        $consultant14->setRoles([$role3->getNom()]);
        $consultant14->setDateCreation(new \DateTime('now'));
        $manager->persist($consultant14);

        $adresse15 = new Adresse();
        $adresse15->setRue("5 rue des verdiers");
        $adresse15->setCP("35470");
        $adresse15->setVille("Bain de bretagne");
        $adresse15->setPays("France");
        $manager->persist($adresse15);
        $consultant15 = new Consultant();
        $consultant15->setNom("Dalibert");
        $consultant15->setPrenom("ou Melle Hamon");
        $consultant15->setTel(null);
        $consultant15->setAdresse($adresse15);
        $consultant15->setEmail(null);
        $consultant15->setDateNaissance(null);
        $consultant15->setHeureNaissance(null);
        $consultant15->setVilleNaissance(null);
        $consultant15->setPaysNaissance(null);
        $consultant15->setSex("Feminin");
        $consultant15->setUsername("hamonDalibert");
        $plainPassword = "123456";
        $encoded = $this->encoder->encodePassword($consultant15, $plainPassword);
        $consultant15->setPassword($encoded);
        $consultant15->setRoles([$role3->getNom()]);
        $consultant15->setDateCreation(new \DateTime('now'));
        $manager->persist($consultant15);

        $adresse16 = new Adresse();
        $adresse16->setRue("Res le themis 64 route de Rennes");
        $adresse16->setCP("44300");
        $adresse16->setVille("Nantes");
        $adresse16->setPays("France");
        $manager->persist($adresse16);

        $consultant16 = new Consultant();
        $consultant16->setNom("Domenech");
        $consultant16->setPrenom("Claire");
        $consultant16->setTel(null);
        $consultant16->setAdresse($adresse16);
        $consultant16->setEmail(null);
        $consultant16->setDateNaissance(null);
        $consultant16->setHeureNaissance(null);
        $consultant16->setVilleNaissance(null);
        $consultant16->setPaysNaissance(null);
        $consultant16->setSex("Feminin");
        $consultant16->setUsername("claireDomenech");
        $plainPassword = "123456";
        $encoded = $this->encoder->encodePassword($consultant16, $plainPassword);
        $consultant16->setPassword($encoded);
        $consultant16->setRoles([$role3->getNom()]);
        $consultant16->setDateCreation(new \DateTime('now'));
        $manager->persist($consultant16);

        $adresse17 = new Adresse();
        $adresse17->setRue("");
        $adresse17->setCP("");
        $adresse17->setVille("");
        $adresse17->setPays("France");
        $manager->persist($adresse17);

        $consultant17 = new Consultant();
        $consultant17->setNom("Civel");
        $consultant17->setPrenom("Dominique");
        $consultant17->setTel(null);
        $consultant17->setAdresse($adresse17);
        $consultant17->setEmail(null);
        $consultant17->setDateNaissance(null);
        $consultant17->setHeureNaissance(null);
        $consultant17->setVilleNaissance(null);
        $consultant17->setPaysNaissance(null);
        $consultant17->setSex("Feminin");
        $consultant17->setUsername("dominiqueCivel");
        $plainPassword = "123456";
        $encoded = $this->encoder->encodePassword($consultant17, $plainPassword);
        $consultant17->setPassword($encoded);
        $consultant17->setRoles([$role3->getNom()]);
        $consultant17->setDateCreation(new \DateTime('now'));
        $manager->persist($consultant17);

        $adresse18 = new Adresse();
        $adresse18->setRue("");
        $adresse18->setCP("");
        $adresse18->setVille("");
        $adresse18->setPays("France");
        $manager->persist($adresse18);

        $consultant18 = new Consultant();
        $consultant18->setNom("Delaunoy");
        $consultant18->setPrenom("Dominique");
        $consultant18->setTel(null);
        $consultant18->setAdresse($adresse18);
        $consultant18->setEmail(null);
        $consultant18->setDateNaissance(null);
        $consultant18->setHeureNaissance(null);
        $consultant18->setVilleNaissance(null);
        $consultant18->setPaysNaissance(null);
        $consultant18->setSex("Feminin");
        $consultant18->setUsername("dominiqueDelaunoy");
        $plainPassword = "123456";
        $encoded = $this->encoder->encodePassword($consultant18, $plainPassword);
        $consultant18->setPassword($encoded);
        $consultant18->setRoles([$role3->getNom()]);
        $consultant18->setDateCreation(new \DateTime('now'));
        $manager->persist($consultant18);

        $adresse19 = new Adresse();
        $adresse19->setRue("2 rue des mouettes");
        $adresse19->setCP("44810");
        $adresse19->setVille("Heric");
        $adresse19->setPays("France");
        $manager->persist($adresse19);
        $consultant19 = new Consultant();
        $consultant19->setNom("Dubois");
        $consultant19->setPrenom("Olivier");
        $consultant19->setTel(null);
        $consultant19->setAdresse($adresse19);
        $consultant19->setEmail(null);
        $consultant19->setDateNaissance(null);
        $consultant19->setHeureNaissance(null);
        $consultant19->setVilleNaissance(null);
        $consultant19->setPaysNaissance(null);
        $consultant19->setSex("Masculin");
        $consultant19->setUsername("olivierDubois");
        $plainPassword = "123456";
        $encoded = $this->encoder->encodePassword($consultant19, $plainPassword);
        $consultant19->setPassword($encoded);
        $consultant19->setRoles([$role3->getNom()]);
        $consultant19->setDateCreation(new \DateTime('now'));
        $manager->persist($consultant19);

        $adresse20 = new Adresse();
        $adresse20->setRue("2 rue des mouettes");
        $adresse20->setCP("44810");
        $adresse20->setVille("Heric");
        $adresse20->setPays("France");
        $manager->persist($adresse20);
        $consultant20 = new Consultant();
        $consultant20->setNom("Dubois");
        $consultant20->setPrenom("Christele");
        $consultant20->setTel(null);
        $consultant20->setAdresse($adresse20);
        $consultant20->setEmail(null);
        $consultant20->setDateNaissance(null);
        $consultant20->setHeureNaissance(null);
        $consultant20->setVilleNaissance(null);
        $consultant20->setPaysNaissance(null);
        $consultant20->setSex("Feminin");
        $consultant20->setUsername("christeleDubois");
        $plainPassword = "123456";
        $encoded = $this->encoder->encodePassword($consultant20, $plainPassword);
        $consultant20->setPassword($encoded);
        $consultant20->setRoles([$role3->getNom()]);
        $consultant20->setDateCreation(new \DateTime('now'));
        $manager->persist($consultant20);

        $adresse21 = new Adresse();
        $adresse21->setRue("Lieu dit Kervagat");
        $adresse21->setCP("29310");
        $adresse21->setVille("Querrien");
        $adresse21->setPays("France");
        $manager->persist($adresse21);
        $consultant21 = new Consultant();
        $consultant21->setNom("Guyomar");
        $consultant21->setPrenom("Marie Claire");
        $consultant21->setTel(null);
        $consultant21->setAdresse($adresse21);
        $consultant21->setEmail(null);
        $consultant21->setDateNaissance(null);
        $consultant21->setHeureNaissance(null);
        $consultant21->setVilleNaissance(null);
        $consultant21->setPaysNaissance(null);
        $consultant21->setSex("Feminin");
        $consultant21->setUsername("marieClaireGuyomar");
        $plainPassword = "123456";
        $encoded = $this->encoder->encodePassword($consultant21, $plainPassword);
        $consultant21->setPassword($encoded);
        $consultant21->setRoles([$role3->getNom()]);
        $consultant21->setDateCreation(new \DateTime('now'));
        $manager->persist($consultant21);

        $adresse22 = new Adresse();
        $adresse22->setRue("10 Avenue Du 11 Novembre 1918");
        $adresse22->setCP("09600");
        $adresse22->setVille("La Bastide Sur L'hers");
        $adresse22->setPays("France");
        $manager->persist($adresse22);
        $consultant22 = new Consultant();
        $consultant22->setNom("Juguet");
        $consultant22->setPrenom("Helene");
        $consultant22->setTel(null);
        $consultant22->setAdresse($adresse22);
        $consultant22->setEmail("helenejuguet0170@orange.fr");
        $consultant22->setDateNaissance(null);
        $consultant22->setHeureNaissance(null);
        $consultant22->setVilleNaissance(null);
        $consultant22->setPaysNaissance(null);
        $consultant22->setSex("Feminin");
        $consultant22->setUsername("heleneJuquet");
        $plainPassword = "123456";
        $encoded = $this->encoder->encodePassword($consultant22, $plainPassword);
        $consultant22->setPassword($encoded);
        $consultant22->setRoles([$role3->getNom()]);
        $consultant22->setDateCreation(new \DateTime('now'));
        $manager->persist($consultant22);

        $adresse23 = new Adresse();
        $adresse23->setRue("");
        $adresse23->setCP("");
        $adresse23->setVille("");
        $adresse23->setPays("France");
        $manager->persist($adresse23);
        $consultant23 = new Consultant();
        $consultant23->setNom("Vaidie");
        $consultant23->setPrenom("Laetitia");
        $consultant23->setTel(null);
        $consultant23->setAdresse($adresse23);
        $consultant23->setEmail("laeti72550@gmail.com");
        $consultant23->setDateNaissance(null);
        $consultant23->setHeureNaissance(null);
        $consultant23->setVilleNaissance(null);
        $consultant23->setPaysNaissance(null);
        $consultant23->setSex("Feminin");
        $consultant23->setUsername("laetitiaVaidie");
        $plainPassword = "123456";
        $encoded = $this->encoder->encodePassword($consultant23, $plainPassword);
        $consultant23->setPassword($encoded);
        $consultant23->setRoles([$role3->getNom()]);
        $consultant23->setDateCreation(new \DateTime('now'));
        $manager->persist($consultant23);

        $adresse24 = new Adresse();
        $adresse24->setRue("");
        $adresse24->setCP("");
        $adresse24->setVille("");
        $adresse24->setPays("France");
        $manager->persist($adresse24);

        $consultant24 = new Consultant();
        $consultant24->setNom("Le net");
        $consultant24->setPrenom("Floriane");
        $consultant24->setTel(null);
        $consultant24->setAdresse($adresse24);
        $consultant24->setEmail(null);
        $consultant24->setDateNaissance(null);
        $consultant24->setHeureNaissance(null);
        $consultant24->setVilleNaissance(null);
        $consultant24->setPaysNaissance(null);
        $consultant24->setSex("Feminin");
        $consultant24->setUsername("florianeLeNet");
        $plainPassword = "123456";
        $encoded = $this->encoder->encodePassword($consultant24, $plainPassword);
        $consultant24->setPassword($encoded);
        $consultant24->setRoles([$role3->getNom()]);
        $consultant24->setDateCreation(new \DateTime('now'));
        $manager->persist($consultant24);

        $adresse25 = new Adresse();
        $adresse25->setRue("La Mariais");
        $adresse25->setCP("44320");
        $adresse25->setVille("St Viaud");
        $adresse25->setPays("France");
        $manager->persist($adresse25);
        $consultant25 = new Consultant();
        $consultant25->setNom("Leclercq");
        $consultant25->setPrenom("Caroline");
        $consultant25->setTel(null);
        $consultant25->setAdresse($adresse25);
        $consultant25->setEmail(null);
        $consultant25->setDateNaissance(null);
        $consultant25->setHeureNaissance(null);
        $consultant25->setVilleNaissance(null);
        $consultant25->setPaysNaissance(null);
        $consultant25->setSex("Feminin");
        $consultant25->setUsername("carolineLeclercq");
        $plainPassword = "123456";
        $encoded = $this->encoder->encodePassword($consultant25, $plainPassword);
        $consultant25->setPassword($encoded);
        $consultant25->setRoles([$role3->getNom()]);
        $consultant25->setDateCreation(new \DateTime('now'));
        $manager->persist($consultant25);

        $adresse26 = new Adresse();
        $adresse26->setRue("");
        $adresse26->setCP("");
        $adresse26->setVille("");
        $adresse26->setPays("France");
        $manager->persist($adresse26);
        $consultant26 = new Consultant();
        $consultant26->setNom("Leray");
        $consultant26->setPrenom("Florian");
        $consultant26->setTel(null);
        $consultant26->setAdresse($adresse26);
        $consultant26->setEmail(null);
        $consultant26->setDateNaissance(null);
        $consultant26->setHeureNaissance(null);
        $consultant26->setVilleNaissance(null);
        $consultant26->setPaysNaissance(null);
        $consultant26->setSex("Masculin");
        $consultant26->setUsername("florianLeray");
        $plainPassword = "123456";
        $encoded = $this->encoder->encodePassword($consultant26, $plainPassword);
        $consultant26->setPassword($encoded);
        $consultant26->setRoles([$role3->getNom()]);
        $consultant26->setDateCreation(new \DateTime('now'));
        $manager->persist($consultant26);

        $adresse27 = new Adresse();
        $adresse27->setRue("2 rue des Mouettes");
        $adresse27->setCP("44810");
        $adresse27->setVille("Heric");
        $adresse27->setPays("France");
        $manager->persist($adresse27);
        $consultant27 = new Consultant();
        $consultant27->setNom("Dubois");
        $consultant27->setPrenom("Lucas");
        $consultant27->setTel(null);
        $consultant27->setAdresse($adresse27);
        $consultant27->setEmail(null);
        $consultant27->setDateNaissance(null);
        $consultant27->setHeureNaissance(null);
        $consultant27->setVilleNaissance(null);
        $consultant27->setPaysNaissance(null);
        $consultant27->setSex("Masculin");
        $consultant27->setUsername("lucasDubois");
        $plainPassword = "123456";
        $encoded = $this->encoder->encodePassword($consultant27, $plainPassword);
        $consultant27->setPassword($encoded);
        $consultant27->setRoles([$role3->getNom()]);
        $consultant27->setDateCreation(new \DateTime('now'));
        $manager->persist($consultant27);

        $adresse28 = new Adresse();
        $adresse28->setRue("");
        $adresse28->setCP("");
        $adresse28->setVille("");
        $adresse28->setPays("France");
        $manager->persist($adresse28);
        $consultant28 = new Consultant();
        $consultant28->setNom("Choblet");
        $consultant28->setPrenom("Marie-Christelle");
        $consultant28->setTel(null);
        $consultant28->setAdresse($adresse28);
        $consultant28->setEmail(null);
        $consultant28->setDateNaissance(null);
        $consultant28->setHeureNaissance(null);
        $consultant28->setVilleNaissance(null);
        $consultant28->setPaysNaissance(null);
        $consultant28->setSex("Feminin");
        $consultant28->setUsername("marieChristelleChoblet");
        $plainPassword = "123456";
        $encoded = $this->encoder->encodePassword($consultant28, $plainPassword);
        $consultant28->setPassword($encoded);
        $consultant28->setRoles([$role3->getNom()]);
        $consultant28->setDateCreation(new \DateTime('now'));
        $manager->persist($consultant28);

        $adresse29 = new Adresse();
        $adresse29->setRue("38 rue Marcel Sembat");
        $adresse29->setCP("44610");
        $adresse29->setVille("Indre");
        $adresse29->setPays("France");
        $manager->persist($adresse29);
        $consultant29 = new Consultant();
        $consultant29->setNom("Morazzani");
        $consultant29->setPrenom("Eric");
        $consultant29->setTel(null);
        $consultant29->setAdresse($adresse29);
        $consultant29->setEmail(null);
        $consultant29->setDateNaissance(null);
        $consultant29->setHeureNaissance(null);
        $consultant29->setVilleNaissance(null);
        $consultant29->setPaysNaissance(null);
        $consultant29->setSex("Masculin");
        $consultant29->setUsername("ericMorazzani");
        $plainPassword = "123456";
        $encoded = $this->encoder->encodePassword($consultant29, $plainPassword);
        $consultant29->setPassword($encoded);
        $consultant29->setRoles([$role3->getNom()]);
        $consultant29->setDateCreation(new \DateTime('now'));
        $manager->persist($consultant29);

        $adresse30 = new Adresse();
        $adresse30->setRue("Le bas champetienne");
        $adresse30->setCP("44590");
        $adresse30->setVille("St Vincent des landes");
        $adresse30->setPays("France");
        $manager->persist($adresse30);
        $consultant30 = new Consultant();
        $consultant30->setNom("Plessis");
        $consultant30->setPrenom("Marine");
        $consultant30->setTel(null);
        $consultant30->setAdresse($adresse30);
        $consultant30->setEmail(null);
        $consultant30->setDateNaissance(null);
        $consultant30->setHeureNaissance(null);
        $consultant30->setVilleNaissance(null);
        $consultant30->setPaysNaissance(null);
        $consultant30->setSex("Feminin");
        $consultant30->setUsername("marinePlessis");
        $plainPassword = "123456";
        $encoded = $this->encoder->encodePassword($consultant30, $plainPassword);
        $consultant30->setPassword($encoded);
        $consultant30->setRoles([$role3->getNom()]);
        $consultant30->setDateCreation(new \DateTime('now'));
        $manager->persist($consultant30);

        $adresse31 = new Adresse();
        $adresse31->setRue("11 rue des Sirenes");
        $adresse31->setCP("44810");
        $adresse31->setVille("Heric");
        $adresse31->setPays("France");
        $manager->persist($adresse31);
        $consultant31 = new Consultant();
        $consultant31->setNom("Rene");
        $consultant31->setPrenom("Madeleine");
        $consultant31->setTel(null);
        $consultant31->setAdresse($adresse31);
        $consultant31->setEmail(null);
        $consultant31->setDateNaissance(null);
        $consultant31->setHeureNaissance(null);
        $consultant31->setVilleNaissance(null);
        $consultant31->setPaysNaissance(null);
        $consultant31->setSex("Feminin");
        $consultant31->setUsername("madeleineRene");
        $plainPassword = "123456";
        $encoded = $this->encoder->encodePassword($consultant31, $plainPassword);
        $consultant31->setPassword($encoded);
        $consultant31->setRoles([$role3->getNom()]);
        $consultant31->setDateCreation(new \DateTime('now'));
        $manager->persist($consultant31);

        $adresse32 = new Adresse();
        $adresse32->setRue("166 route des puymains Bourgneuf en retz");
        $adresse32->setCP("44580");
        $adresse32->setVille("Villeneuve en retz");
        $adresse32->setPays("France");
        $manager->persist($adresse32);
        $consultant32 = new Consultant();
        $consultant32->setNom("Rousseau");
        $consultant32->setPrenom("Emilie");
        $consultant32->setTel(null);
        $consultant32->setAdresse($adresse32);
        $consultant32->setEmail(null);
        $consultant32->setDateNaissance(null);
        $consultant32->setHeureNaissance(null);
        $consultant32->setVilleNaissance(null);
        $consultant32->setPaysNaissance(null);
        $consultant32->setSex("Feminin");
        $consultant32->setUsername("emilieRousseau");
        $plainPassword = "123456";
        $encoded = $this->encoder->encodePassword($consultant32, $plainPassword);
        $consultant32->setPassword($encoded);
        $consultant32->setRoles([$role3->getNom()]);
        $consultant32->setDateCreation(new \DateTime('now'));
        $manager->persist($consultant32);

        $adresse33 = new Adresse();
        $adresse33->setRue("32 b Impasse du pont Tharon");
        $adresse33->setCP("44770");
        $adresse33->setVille("La plaine sur mer");
        $adresse33->setPays("France");
        $manager->persist($adresse33);
        $consultant33 = new Consultant();
        $consultant33->setNom("Rousseleau");
        $consultant33->setPrenom("Sebastien");
        $consultant33->setTel(null);
        $consultant33->setAdresse($adresse33);
        $consultant33->setEmail(null);
        $consultant33->setDateNaissance(null);
        $consultant33->setHeureNaissance(null);
        $consultant33->setVilleNaissance(null);
        $consultant33->setPaysNaissance(null);
        $consultant33->setSex("Masculin");
        $consultant33->setUsername("sebastienRousseleau");
        $plainPassword = "123456";
        $encoded = $this->encoder->encodePassword($consultant33, $plainPassword);
        $consultant33->setPassword($encoded);
        $consultant33->setRoles([$role3->getNom()]);
        $consultant33->setDateCreation(new \DateTime('now'));
        $manager->persist($consultant33);

        $adresse34 = new Adresse();
        $adresse34->setRue("francois miterand");
        $adresse34->setCP("35000");
        $adresse34->setVille("Rennes");
        $adresse34->setPays("France");
        $manager->persist($adresse34);
        $consultant34 = new Consultant();
        $consultant34->setNom("Redersdorff");
        $consultant34->setPrenom("Sandrine");
        $consultant34->setTel(null);
        $consultant34->setAdresse($adresse34);
        $consultant34->setEmail(null);
        $consultant34->setDateNaissance(null);
        $consultant34->setHeureNaissance(null);
        $consultant34->setVilleNaissance(null);
        $consultant34->setPaysNaissance(null);
        $consultant34->setSex("Feminin");
        $consultant34->setUsername("sandrineRedersdorff");
        $plainPassword = "123456";
        $encoded = $this->encoder->encodePassword($consultant34, $plainPassword);
        $consultant34->setPassword($encoded);
        $consultant34->setRoles([$role3->getNom()]);
        $consultant34->setDateCreation(new \DateTime('now'));
        $manager->persist($consultant34);

        $adresse35 = new Adresse();
        $adresse35->setRue("");
        $adresse35->setCP("");
        $adresse35->setVille("");
        $adresse35->setPays("France");
        $manager->persist($adresse35);
        $consultant35 = new Consultant();
        $consultant35->setNom("Bigot");
        $consultant35->setPrenom("Xavier");
        $consultant35->setTel(null);
        $consultant35->setAdresse($adresse35);
        $consultant35->setEmail(null);
        $consultant35->setDateNaissance(null);
        $consultant35->setHeureNaissance(null);
        $consultant35->setVilleNaissance(null);
        $consultant35->setPaysNaissance(null);
        $consultant35->setSex("Masculine");
        $consultant35->setUsername("xavierBigot");
        $plainPassword = "123456";
        $encoded = $this->encoder->encodePassword($consultant35, $plainPassword);
        $consultant35->setPassword($encoded);
        $consultant35->setRoles([$role3->getNom()]);
        $consultant35->setDateCreation(new \DateTime('now'));
        $manager->persist($consultant35);

        //------------------------------------------------------------------------------------
        //Création des Commentaires
        //--------------------------------------------------------------------------------------
        $commentaire1 = new CommentaireConsultant();
        $commentaire1->setDescription("Ceci est un commentaire 1");
        $commentaire1->setDate(new \DateTime('now'));
        $commentaire1->setConsultant($consultant1);
        $manager->persist($commentaire1);

        $commentaire2 = new CommentaireConsultant();
        $commentaire2->setDescription("Ceci est un commentaire 2");
        $commentaire2->setDate(new \DateTime('now'));
        $commentaire2->setConsultant($consultant1);
        $manager->persist($commentaire2);

        $commentaire3 = new CommentaireConsultant();
        $commentaire3->setDescription("Ceci est un commentaire 3");
        $commentaire3->setDate(new \DateTime('now'));
        $commentaire3->setConsultant($consultant1);
        $manager->persist($commentaire3);

        $commentaire4 = new CommentaireConsultant();
        $commentaire4->setDescription("Ceci est un commentaire 4");
        $commentaire4->setDate(new \DateTime('now'));
        $commentaire4->setConsultant($consultant3);
        $manager->persist($commentaire4);

        //------------------------------------------------------------------------------------
        //Création des Rendez-vous
        //--------------------------------------------------------------------------------------
        $rdv1 = new RendezVous();
        $monsieurMadame = $consultant1->getSex() == "Masculin" ? " M." : " Mm.";
        $rdv1->setTitre("Rendez-vous avec " . $monsieurMadame . $consultant1->getNom() . " " . $consultant1->getPrenom());
        $rdv1->setCreateur($user1);
        $rdv1->setDateDebut(new \DateTime("2021-04-19 15:28"));
        $rdv1->setDateFin(new \DateTime("2021-04-19 18:28"));
        $rdv1->setCommentaire("le consultant est en amélioration depuis sa dernière scéance");
        $rdv1->setConsultant($consultant1);
        $manager->persist($rdv1);

        $rdv2 = new RendezVous();
        $monsieurMadame = $consultant2->getSex() == "Masculin" ? " M." : " Mm.";
        $rdv2->setTitre("Rendez-vous avec " . $monsieurMadame . $consultant2->getNom() . " " . $consultant2->getPrenom());
        $rdv2->setCreateur($user2);
        $rdv2->setDateDebut(new \DateTime("2021-05-28 14:15"));
        $rdv2->setDateFin(new \DateTime("2021-05-28 17:15"));
        $rdv2->setCommentaire(null);
        $rdv2->setConsultant($consultant2);
        $manager->persist($rdv2);

        $rdv3 = new RendezVous();
        $monsieurMadame = $consultant3->getSex() == "Masculin" ? " M." : " Mm.";
        $rdv3->setTitre("Rendez-vous avec " . $monsieurMadame . $consultant3->getNom() . " " . $consultant3->getPrenom());
        $rdv3->setCreateur($user3);
        $rdv3->setDateDebut(new \DateTime("2021-06-08 11:55"));
        $rdv3->setDateFin(new \DateTime("2021-06-08 14:55"));
        $rdv3->setCommentaire("Princesse Charline vient pour la première fois ");
        $rdv3->setConsultant($consultant3);
        $manager->persist($rdv3);




        //--------------------------------------------------------------------------------------
        //Création des Factures par mois 2019
        //--------------------------------------------------------------------------------------
        $facturejanvier19 = new Facture();
        $facturejanvier19->setConsultant($consultant1);
        $facturejanvier19->setNumeroFacture("2019-01-0120");
        $facturejanvier19->setDate(new \DateTime("07-01-2019"));
        $facturejanvier19->setTypeDePaiement($type1);
        $facturejanvier19->setNumeroChequeOuPaypal(45421548787);
        $manager->persist($facturejanvier19);
        $ligneFacturejanvier19 = new LigneFacture();
        $ligneFacturejanvier19->setService($service2);
        $ligneFacturejanvier19->setMontant(1800);
        $ligneFacturejanvier19->setQuantite(5);
        $ligneFacturejanvier19->setFacture($facturejanvier19);
        $manager->persist($ligneFacturejanvier19);
        $facturejanvier19->addLigneFacture($ligneFacturejanvier19);
        $manager->persist($facturejanvier19);


        $facturejanvier119 = new Facture();
        $facturejanvier119->setConsultant($consultant2);
        $facturejanvier119->setNumeroFacture("2019-01-0003");
        $facturejanvier119->setDate(new \DateTime("07-01-2019"));
        $facturejanvier119->setTypeDePaiement($type2);
        $facturejanvier119->setNumeroChequeOuPaypal(1378912348577);
        $manager->persist($facturejanvier119);
        $ligneFacturejanvier119 = new LigneFacture();
        $ligneFacturejanvier119->setService($service3);
        $ligneFacturejanvier119->setMontant(250);
        $ligneFacturejanvier119->setQuantite(2);
        $ligneFacturejanvier119->setFacture($facturejanvier119);
        $manager->persist($ligneFacturejanvier119);
        $facturejanvier119->addLigneFacture($ligneFacturejanvier119);
        $manager->persist($facturejanvier119);


        $facturejanvier219 = new Facture();
        $facturejanvier219->setConsultant($consultant3);
        $facturejanvier219->setNumeroFacture("2019-01-0006");
        $facturejanvier219->setDate(new \DateTime("11-01-2019"));
        $facturejanvier219->setTypeDePaiement($type3);
        $facturejanvier219->setNumeroChequeOuPaypal(null);
        $manager->persist($facturejanvier219);
        $ligneFacturejanvier219 = new LigneFacture();
        $ligneFacturejanvier219 ->setService($service1);
        $ligneFacturejanvier219->setMontant(90);
        $ligneFacturejanvier219->setQuantite(1);
        $ligneFacturejanvier219->setFacture($facturejanvier219);
        $manager->persist($ligneFacturejanvier219);
        $facturejanvier219->addLigneFacture($ligneFacturejanvier219);
        $manager->persist($facturejanvier219);


        $facturefevrier119 = new Facture();
        $facturefevrier119->setConsultant($consultant1);
        $facturefevrier119->setNumeroFacture("2019-02-0009");
        $facturefevrier119->setDate(new \DateTime("07-02-2019"));
        $facturefevrier119->setTypeDePaiement($type1);
        $facturefevrier119->setNumeroChequeOuPaypal(45421548787);
        $manager->persist($facturefevrier119);
        $ligneFacturefevrier119 = new LigneFacture();
        $ligneFacturefevrier119->setService($service4);
        $ligneFacturefevrier119->setMontant(426);
        $ligneFacturefevrier119->setQuantite(4);
        $ligneFacturefevrier119->setFacture($facturefevrier119);
        $manager->persist($ligneFacturefevrier119);
        $facturefevrier119->addLigneFacture($ligneFacturefevrier119);
        $manager->persist($facturefevrier119);

        $facturefevrier219 = new Facture();
        $facturefevrier219->setConsultant($consultant2);
        $facturefevrier219->setNumeroFacture("2019-02-0019");
        $facturefevrier219->setDate(new \DateTime("14-02-2019"));
        $facturefevrier219->setTypeDePaiement($type2);
        $facturefevrier219->setNumeroChequeOuPaypal(45421548787);
        $manager->persist($facturefevrier219);
        $ligneFacturefevrier219 = new LigneFacture();
        $ligneFacturefevrier219->setService($service5);
        $ligneFacturefevrier219->setMontant(376);
        $ligneFacturefevrier219->setQuantite(2);
        $ligneFacturefevrier219->setFacture($facturefevrier219);
        $manager->persist($ligneFacturefevrier219);
        $facturefevrier219->addLigneFacture($ligneFacturefevrier219);
        $manager->persist($facturefevrier219);


        $facturefevrier319 = new Facture();
        $facturefevrier319->setConsultant($consultant3);
        $facturefevrier319->setNumeroFacture("2019-02-0007");
        $facturefevrier319->setDate(new \DateTime("21-02-2019"));
        $facturefevrier319->setTypeDePaiement($type3);
        $facturefevrier319->setNumeroChequeOuPaypal(45421548787);
        $manager->persist($facturefevrier319);
        $ligneFacturefevrier319 = new LigneFacture();
        $ligneFacturefevrier319->setService($service6);
        $ligneFacturefevrier319->setMontant(776);
        $ligneFacturefevrier319->setQuantite(4);
        $ligneFacturefevrier319->setFacture($facturefevrier319);
        $manager->persist($ligneFacturefevrier319);
        $facturefevrier319->addLigneFacture($ligneFacturefevrier319);
        $manager->persist($facturefevrier319);


        $facturemars119 = new Facture();
        $facturemars119->setConsultant($consultant1);
        $facturemars119->setNumeroFacture("2019-03-0013");
        $facturemars119->setDate(new \DateTime("07-03-2019"));
        $facturemars119->setTypeDePaiement($type1);
        $facturemars119->setNumeroChequeOuPaypal(45421548787);
        $manager->persist($facturemars119);
        $ligneFacturemars119 = new LigneFacture();
        $ligneFacturemars119->setService($service7);
        $ligneFacturemars119->setMontant(376);
        $ligneFacturemars119->setQuantite(2);
        $ligneFacturemars119->setFacture($facturemars119);
        $manager->persist($ligneFacturemars119);
        $facturemars119->addLigneFacture($ligneFacturemars119);
        $manager->persist($facturemars119);

        $facturemars219 = new Facture();
        $facturemars219->setConsultant($consultant2);
        $facturemars219->setNumeroFacture("2019-03-0023");
        $facturemars219->setDate(new \DateTime("14-03-2019"));
        $facturemars219->setTypeDePaiement($type2);
        $facturemars219->setNumeroChequeOuPaypal(45421548787);
        $manager->persist($facturemars219);
        $ligneFacturemars219 = new LigneFacture();
        $ligneFacturemars219->setService($service8);
        $ligneFacturemars219->setMontant(899);
        $ligneFacturemars219->setQuantite(3);
        $ligneFacturemars219->setFacture($facturemars219);
        $manager->persist($ligneFacturemars219);
        $facturemars219->addLigneFacture($ligneFacturemars219);
        $manager->persist($facturemars219);

        $facturemars319 = new Facture();
        $facturemars319->setConsultant($consultant3);
        $facturemars319->setNumeroFacture("2019-03-0063");
        $facturemars319->setDate(new \DateTime("21-03-2019"));
        $facturemars319->setTypeDePaiement($type3);
        $facturemars319->setNumeroChequeOuPaypal(45421548787);
        $manager->persist($facturemars319);
        $ligneFacturemars319 = new LigneFacture();
        $ligneFacturemars319->setService($service9);
        $ligneFacturemars319->setMontant(540);
        $ligneFacturemars319->setQuantite(2);
        $ligneFacturemars319->setFacture($facturemars319);
        $manager->persist($ligneFacturemars319);
        $facturemars319->addLigneFacture($ligneFacturemars319);
        $manager->persist($facturemars319);


        $factureavril119 = new Facture();
        $factureavril119->setConsultant($consultant1);
        $factureavril119->setNumeroFacture("2019-04-0013");
        $factureavril119->setDate(new \DateTime("07-04-2019"));
        $factureavril119->setTypeDePaiement($type1);
        $factureavril119->setNumeroChequeOuPaypal(45421548787);
        $manager->persist($factureavril119);
        $ligneFactureavril119 = new LigneFacture();
        $ligneFactureavril119->setService($service7);
        $ligneFactureavril119->setMontant(376);
        $ligneFactureavril119->setQuantite(2);
        $ligneFactureavril119->setFacture($factureavril119);
        $manager->persist($ligneFactureavril119);
        $factureavril119->addLigneFacture($ligneFactureavril119);
        $manager->persist($factureavril119);

        $factureavril219 = new Facture();
        $factureavril219->setConsultant($consultant2);
        $factureavril219->setNumeroFacture("2019-04-0023");
        $factureavril219->setDate(new \DateTime("14-04-2019"));
        $factureavril219->setTypeDePaiement($type2);
        $factureavril219->setNumeroChequeOuPaypal(45421548787);
        $manager->persist($factureavril219);
        $ligneFactureavril219 = new LigneFacture();
        $ligneFactureavril219->setService($service8);
        $ligneFactureavril219->setMontant(899);
        $ligneFactureavril219->setQuantite(3);
        $ligneFactureavril219->setFacture($factureavril219);
        $manager->persist($ligneFactureavril219);
        $factureavril219->addLigneFacture($ligneFactureavril219);
        $manager->persist($factureavril219);

        $factureavril319 = new Facture();
        $factureavril319->setConsultant($consultant3);
        $factureavril319->setNumeroFacture("2019-04-0063");
        $factureavril319->setDate(new \DateTime("21-04-2019"));
        $factureavril319->setTypeDePaiement($type3);
        $factureavril319->setNumeroChequeOuPaypal(45421548787);
        $manager->persist($factureavril319);
        $ligneFactureavril319 = new LigneFacture();
        $ligneFactureavril319->setService($service9);
        $ligneFactureavril319->setMontant(540);
        $ligneFactureavril319->setQuantite(2);
        $ligneFactureavril319->setFacture($factureavril319);
        $manager->persist($ligneFactureavril319);
        $factureavril319->addLigneFacture($ligneFactureavril319);
        $manager->persist($factureavril319);


        $facturemai119 = new Facture();
        $facturemai119->setConsultant($consultant1);
        $facturemai119->setNumeroFacture("2019-05-0013");
        $facturemai119->setDate(new \DateTime("07-05-2019"));
        $facturemai119->setTypeDePaiement($type1);
        $facturemai119->setNumeroChequeOuPaypal(45421548787);
        $manager->persist($facturemai119);
        $ligneFacturemai119 = new LigneFacture();
        $ligneFacturemai119->setService($service7);
        $ligneFacturemai119->setMontant(376);
        $ligneFacturemai119->setQuantite(2);
        $ligneFacturemai119->setFacture($facturemai119);
        $manager->persist($ligneFacturemai119);
        $facturemai119->addLigneFacture($ligneFacturemai119);
        $manager->persist($facturemai119);

        $facturemai219 = new Facture();
        $facturemai219->setConsultant($consultant2);
        $facturemai219->setNumeroFacture("2019-05-0023");
        $facturemai219->setDate(new \DateTime("14-05-2019"));
        $facturemai219->setTypeDePaiement($type2);
        $facturemai219->setNumeroChequeOuPaypal(45421548787);
        $manager->persist($facturemai219);
        $ligneFacturemai219 = new LigneFacture();
        $ligneFacturemai219->setService($service8);
        $ligneFacturemai219->setMontant(899);
        $ligneFacturemai219->setQuantite(3);
        $ligneFacturemai219->setFacture($facturemai219);
        $manager->persist($ligneFacturemai219);
        $facturemai219->addLigneFacture($ligneFacturemai219);
        $manager->persist($facturemai219);

        $facturemai319 = new Facture();
        $facturemai319->setConsultant($consultant3);
        $facturemai319->setNumeroFacture("2019-05-0063");
        $facturemai319->setDate(new \DateTime("21-05-2019"));
        $facturemai319->setTypeDePaiement($type3);
        $facturemai319->setNumeroChequeOuPaypal(45421548787);
        $manager->persist($facturemai319);
        $ligneFacturemai319 = new LigneFacture();
        $ligneFacturemai319->setService($service9);
        $ligneFacturemai319->setMontant(540);
        $ligneFacturemai319->setQuantite(2);
        $ligneFacturemai319->setFacture($facturemai319);
        $manager->persist($ligneFacturemai319);
        $facturemai319->addLigneFacture($ligneFacturemai319);
        $manager->persist($facturemai319);



        $facturejuin119 = new Facture();
        $facturejuin119->setConsultant($consultant1);
        $facturejuin119->setNumeroFacture("2019-06-0013");
        $facturejuin119->setDate(new \DateTime("07-06-2019"));
        $facturejuin119->setTypeDePaiement($type1);
        $facturejuin119->setNumeroChequeOuPaypal(45421548787);
        $manager->persist($facturejuin119);
        $ligneFacturejuin119 = new LigneFacture();
        $ligneFacturejuin119->setService($service7);
        $ligneFacturejuin119->setMontant(376);
        $ligneFacturejuin119->setQuantite(2);
        $ligneFacturejuin119->setFacture($facturejuin119);
        $manager->persist($ligneFacturejuin119);
        $facturejuin119->addLigneFacture($ligneFacturejuin119);
        $manager->persist($facturejuin119);

        $facturejuin219 = new Facture();
        $facturejuin219->setConsultant($consultant2);
        $facturejuin219->setNumeroFacture("2019-06-0023");
        $facturejuin219->setDate(new \DateTime("14-06-2019"));
        $facturejuin219->setTypeDePaiement($type2);
        $facturejuin219->setNumeroChequeOuPaypal(45421548787);
        $manager->persist($facturejuin219);
        $ligneFacturejuin219 = new LigneFacture();
        $ligneFacturejuin219->setService($service8);
        $ligneFacturejuin219->setMontant(899);
        $ligneFacturejuin219->setQuantite(3);
        $ligneFacturejuin219->setFacture($facturejuin219);
        $manager->persist($ligneFacturejuin219);
        $facturejuin219->addLigneFacture($ligneFacturejuin219);
        $manager->persist($facturejuin219);

        $facturejuin319 = new Facture();
        $facturejuin319->setConsultant($consultant3);
        $facturejuin319->setNumeroFacture("2019-06-0063");
        $facturejuin319->setDate(new \DateTime("21-06-2019"));
        $facturejuin319->setTypeDePaiement($type3);
        $facturejuin319->setNumeroChequeOuPaypal(45421548787);
        $manager->persist($facturejuin319);
        $ligneFacturejuin319 = new LigneFacture();
        $ligneFacturejuin319->setService($service9);
        $ligneFacturejuin319->setMontant(540);
        $ligneFacturejuin319->setQuantite(2);
        $ligneFacturejuin319->setFacture($facturejuin319);
        $manager->persist($ligneFacturejuin319);
        $facturejuin319->addLigneFacture($ligneFacturejuin319);
        $manager->persist($facturejuin319);



        $facturejuillet119 = new Facture();
        $facturejuillet119->setConsultant($consultant1);
        $facturejuillet119->setNumeroFacture("2019-07-0013");
        $facturejuillet119->setDate(new \DateTime("07-07-2019"));
        $facturejuillet119->setTypeDePaiement($type1);
        $facturejuillet119->setNumeroChequeOuPaypal(45421548787);
        $manager->persist($facturejuillet119);
        $ligneFacturejuillet119 = new LigneFacture();
        $ligneFacturejuillet119->setService($service7);
        $ligneFacturejuillet119->setMontant(376);
        $ligneFacturejuillet119->setQuantite(2);
        $ligneFacturejuillet119->setFacture($facturejuillet119);
        $manager->persist($ligneFacturejuillet119);
        $facturejuillet119->addLigneFacture($ligneFacturejuillet119);
        $manager->persist($facturejuillet119);

        $facturejuillet219 = new Facture();
        $facturejuillet219->setConsultant($consultant2);
        $facturejuillet219->setNumeroFacture("2019-07-0023");
        $facturejuillet219->setDate(new \DateTime("14-07-2019"));
        $facturejuillet219->setTypeDePaiement($type2);
        $facturejuillet219->setNumeroChequeOuPaypal(45421548787);
        $manager->persist($facturejuillet219);
        $ligneFacturejuillet219 = new LigneFacture();
        $ligneFacturejuillet219->setService($service8);
        $ligneFacturejuillet219->setMontant(899);
        $ligneFacturejuillet219->setQuantite(3);
        $ligneFacturejuillet219->setFacture($facturejuillet219);
        $manager->persist($ligneFacturejuillet219);
        $facturejuillet219->addLigneFacture($ligneFacturejuillet219);
        $manager->persist($facturejuillet219);

        $facturejuillet319 = new Facture();
        $facturejuillet319->setConsultant($consultant3);
        $facturejuillet319->setNumeroFacture("2019-07-0063");
        $facturejuillet319->setDate(new \DateTime("21-07-2019"));
        $facturejuillet319->setTypeDePaiement($type3);
        $facturejuillet319->setNumeroChequeOuPaypal(45421548787);
        $manager->persist($facturejuillet319);
        $ligneFacturejuillet319 = new LigneFacture();
        $ligneFacturejuillet319->setService($service9);
        $ligneFacturejuillet319->setMontant(540);
        $ligneFacturejuillet319->setQuantite(2);
        $ligneFacturejuillet319->setFacture($facturejuillet319);
        $manager->persist($ligneFacturejuillet319);
        $facturejuillet319->addLigneFacture($ligneFacturejuillet319);
        $manager->persist($facturejuillet319);




        $factureaout119 = new Facture();
        $factureaout119->setConsultant($consultant1);
        $factureaout119->setNumeroFacture("2019-08-0013");
        $factureaout119->setDate(new \DateTime("07-08-2019"));
        $factureaout119->setTypeDePaiement($type1);
        $factureaout119->setNumeroChequeOuPaypal(45421548787);
        $manager->persist($factureaout119);
        $ligneFactureaout119 = new LigneFacture();
        $ligneFactureaout119->setService($service7);
        $ligneFactureaout119->setMontant(376);
        $ligneFactureaout119->setQuantite(2);
        $ligneFactureaout119->setFacture($factureaout119);
        $manager->persist($ligneFactureaout119);
        $factureaout119->addLigneFacture($ligneFactureaout119);
        $manager->persist($factureaout119);

        $factureaout219 = new Facture();
        $factureaout219->setConsultant($consultant2);
        $factureaout219->setNumeroFacture("2019-08-0023");
        $factureaout219->setDate(new \DateTime("14-08-2019"));
        $factureaout219->setTypeDePaiement($type2);
        $factureaout219->setNumeroChequeOuPaypal(45421548787);
        $manager->persist($factureaout219);
        $ligneFactureaout219 = new LigneFacture();
        $ligneFactureaout219->setService($service8);
        $ligneFactureaout219->setMontant(899);
        $ligneFactureaout219->setQuantite(3);
        $ligneFactureaout219->setFacture($factureaout219);
        $manager->persist($ligneFactureaout219);
        $factureaout219->addLigneFacture($ligneFactureaout219);
        $manager->persist($factureaout219);

        $facturesaout319 = new Facture();
        $facturesaout319->setConsultant($consultant3);
        $facturesaout319->setNumeroFacture("2019-08-0063");
        $facturesaout319->setDate(new \DateTime("21-08-2019"));
        $facturesaout319->setTypeDePaiement($type3);
        $facturesaout319->setNumeroChequeOuPaypal(45421548787);
        $manager->persist($facturesaout319);
        $ligneFactureaout319 = new LigneFacture();
        $ligneFactureaout319->setService($service9);
        $ligneFactureaout319->setMontant(540);
        $ligneFactureaout319->setQuantite(2);
        $ligneFactureaout319->setFacture($facturesaout319);
        $manager->persist($ligneFactureaout319);
        $facturesaout319->addLigneFacture($ligneFactureaout319);
        $manager->persist($facturesaout319);






        $facturesseptembre119 = new Facture();
        $facturesseptembre119->setConsultant($consultant1);
        $facturesseptembre119->setNumeroFacture("2019-09-0013");
        $facturesseptembre119->setDate(new \DateTime("07-09-2019"));
        $facturesseptembre119->setTypeDePaiement($type1);
        $facturesseptembre119->setNumeroChequeOuPaypal(45421548787);
        $manager->persist($facturesseptembre119);
        $ligneFacturesseptembre119 = new LigneFacture();
        $ligneFacturesseptembre119->setService($service7);
        $ligneFacturesseptembre119->setMontant(376);
        $ligneFacturesseptembre119->setQuantite(2);
        $ligneFacturesseptembre119->setFacture($facturesseptembre119);
        $manager->persist($ligneFacturesseptembre119);
        $facturesseptembre119->addLigneFacture($ligneFacturesseptembre119);
        $manager->persist($facturesseptembre119);

        $facturesseptembre219 = new Facture();
        $facturesseptembre219->setConsultant($consultant2);
        $facturesseptembre219->setNumeroFacture("2019-09-0023");
        $facturesseptembre219->setDate(new \DateTime("14-09-2019"));
        $facturesseptembre219->setTypeDePaiement($type2);
        $facturesseptembre219->setNumeroChequeOuPaypal(45421548787);
        $manager->persist($facturesseptembre219);
        $ligneFacturesseptembre219 = new LigneFacture();
        $ligneFacturesseptembre219->setService($service8);
        $ligneFacturesseptembre219->setMontant(899);
        $ligneFacturesseptembre219->setQuantite(3);
        $ligneFacturesseptembre219->setFacture($facturesseptembre219);
        $manager->persist($ligneFacturesseptembre219);
        $facturesseptembre219->addLigneFacture($ligneFacturesseptembre219);
        $manager->persist($facturesseptembre219);

        $facturesseptembre319 = new Facture();
        $facturesseptembre319->setConsultant($consultant3);
        $facturesseptembre319->setNumeroFacture("2019-09-0063");
        $facturesseptembre319->setDate(new \DateTime("21-09-2019"));
        $facturesseptembre319->setTypeDePaiement($type3);
        $facturesseptembre319->setNumeroChequeOuPaypal(45421548787);
        $manager->persist($facturesseptembre319);
        $ligneFacturesseptembre319 = new LigneFacture();
        $ligneFacturesseptembre319->setService($service9);
        $ligneFacturesseptembre319->setMontant(540);
        $ligneFacturesseptembre319->setQuantite(2);
        $ligneFacturesseptembre319->setFacture($facturesseptembre319);
        $manager->persist($ligneFacturesseptembre319);
        $facturesseptembre319->addLigneFacture($ligneFacturesseptembre319);
        $manager->persist($facturesseptembre319);







        $facturesoctobre119 = new Facture();
        $facturesoctobre119->setConsultant($consultant1);
        $facturesoctobre119->setNumeroFacture("2019-10-0013");
        $facturesoctobre119->setDate(new \DateTime("07-10-2019"));
        $facturesoctobre119->setTypeDePaiement($type1);
        $facturesoctobre119->setNumeroChequeOuPaypal(45421548787);
        $manager->persist($facturesoctobre119);
        $ligneFactureoctobre119 = new LigneFacture();
        $ligneFactureoctobre119->setService($service7);
        $ligneFactureoctobre119->setMontant(376);
        $ligneFactureoctobre119->setQuantite(2);
        $ligneFactureoctobre119->setFacture($facturesoctobre119);
        $manager->persist($ligneFactureoctobre119);
        $facturesoctobre119->addLigneFacture($ligneFactureoctobre119);
        $manager->persist($facturesoctobre119);

        $facturesoctobre219 = new Facture();
        $facturesoctobre219->setConsultant($consultant2);
        $facturesoctobre219->setNumeroFacture("2019-10-0023");
        $facturesoctobre219->setDate(new \DateTime("14-10-2019"));
        $facturesoctobre219->setTypeDePaiement($type2);
        $facturesoctobre219->setNumeroChequeOuPaypal(45421548787);
        $manager->persist($facturesoctobre219);
        $ligneFacturesoctobre219 = new LigneFacture();
        $ligneFacturesoctobre219->setService($service8);
        $ligneFacturesoctobre219->setMontant(899);
        $ligneFacturesoctobre219->setQuantite(3);
        $ligneFacturesoctobre219->setFacture($facturesoctobre219);
        $manager->persist($ligneFacturesoctobre219);
        $facturesoctobre219->addLigneFacture($ligneFacturesoctobre219);
        $manager->persist($facturesoctobre219);

        $facturesoctobre319 = new Facture();
        $facturesoctobre319->setConsultant($consultant3);
        $facturesoctobre319->setNumeroFacture("2019-10-0063");
        $facturesoctobre319->setDate(new \DateTime("21-10-2019"));
        $facturesoctobre319->setTypeDePaiement($type3);
        $facturesoctobre319->setNumeroChequeOuPaypal(45421548787);
        $manager->persist($facturesoctobre319);
        $ligneFacturesoctobre319 = new LigneFacture();
        $ligneFacturesoctobre319->setService($service9);
        $ligneFacturesoctobre319->setMontant(540);
        $ligneFacturesoctobre319->setQuantite(2);
        $ligneFacturesoctobre319->setFacture($facturesoctobre319);
        $manager->persist($ligneFacturesoctobre319);
        $facturesoctobre319->addLigneFacture($ligneFacturesoctobre319);
        $manager->persist($facturesoctobre319);





        $facturesnovembre119 = new Facture();
        $facturesnovembre119->setConsultant($consultant1);
        $facturesnovembre119->setNumeroFacture("2019-11-0013");
        $facturesnovembre119->setDate(new \DateTime("07-11-2019"));
        $facturesnovembre119->setTypeDePaiement($type1);
        $facturesnovembre119->setNumeroChequeOuPaypal(45421548787);
        $manager->persist($facturesnovembre119);
        $ligneFacturesnovembre119 = new LigneFacture();
        $ligneFacturesnovembre119->setService($service7);
        $ligneFacturesnovembre119->setMontant(376);
        $ligneFacturesnovembre119->setQuantite(2);
        $ligneFacturesnovembre119->setFacture($facturesnovembre119);
        $manager->persist($ligneFacturesnovembre119);
        $facturesnovembre119->addLigneFacture($ligneFacturesnovembre119);
        $manager->persist($facturesnovembre119);

        $facturesnovembre219 = new Facture();
        $facturesnovembre219->setConsultant($consultant2);
        $facturesnovembre219->setNumeroFacture("2019-11-0023");
        $facturesnovembre219->setDate(new \DateTime("14-11-2019"));
        $facturesnovembre219->setTypeDePaiement($type2);
        $facturesnovembre219->setNumeroChequeOuPaypal(45421548787);
        $manager->persist($facturesnovembre219);
        $ligneFacturesnovembre219 = new LigneFacture();
        $ligneFacturesnovembre219->setService($service8);
        $ligneFacturesnovembre219->setMontant(899);
        $ligneFacturesnovembre219->setQuantite(3);
        $ligneFacturesnovembre219->setFacture($facturesnovembre219);
        $manager->persist($ligneFacturesnovembre219);
        $facturesnovembre219->addLigneFacture($ligneFacturesnovembre219);
        $manager->persist($facturesnovembre219);

        $facturesnovembre319 = new Facture();
        $facturesnovembre319->setConsultant($consultant3);
        $facturesnovembre319->setNumeroFacture("2019-11-0063");
        $facturesnovembre319->setDate(new \DateTime("21-11-2019"));
        $facturesnovembre319->setTypeDePaiement($type3);
        $facturesnovembre319->setNumeroChequeOuPaypal(45421548787);
        $manager->persist($facturesnovembre319);
        $ligneFacturesnovembre319 = new LigneFacture();
        $ligneFacturesnovembre319->setService($service9);
        $ligneFacturesnovembre319->setMontant(540);
        $ligneFacturesnovembre319->setQuantite(2);
        $ligneFacturesnovembre319->setFacture($facturesnovembre319);
        $manager->persist($ligneFacturesnovembre319);
        $facturesnovembre319->addLigneFacture($ligneFacturesnovembre319);
        $manager->persist($facturesnovembre319);





        $facturesdecembre119 = new Facture();
        $facturesdecembre119->setConsultant($consultant1);
        $facturesdecembre119->setNumeroFacture("2019-12-0013");
        $facturesdecembre119->setDate(new \DateTime("07-12-2019"));
        $facturesdecembre119->setTypeDePaiement($type1);
        $facturesdecembre119->setNumeroChequeOuPaypal(45421548787);
        $manager->persist($facturesdecembre119);
        $ligneFacturedecembre119 = new LigneFacture();
        $ligneFacturedecembre119->setService($service7);
        $ligneFacturedecembre119->setMontant(376);
        $ligneFacturedecembre119->setQuantite(2);
        $ligneFacturedecembre119->setFacture($facturesdecembre119);
        $manager->persist($ligneFacturedecembre119);
        $facturesdecembre119->addLigneFacture($ligneFacturedecembre119);
        $manager->persist($facturesdecembre119);

        $facturesdecembre219 = new Facture();
        $facturesdecembre219->setConsultant($consultant2);
        $facturesdecembre219->setNumeroFacture("2019-12-0023");
        $facturesdecembre219->setDate(new \DateTime("14-12-2019"));
        $facturesdecembre219->setTypeDePaiement($type2);
        $facturesdecembre219->setNumeroChequeOuPaypal(45421548787);
        $manager->persist($facturesdecembre219);
        $ligneFacturesdecembre219 = new LigneFacture();
        $ligneFacturesdecembre219->setService($service8);
        $ligneFacturesdecembre219->setMontant(899);
        $ligneFacturesdecembre219->setQuantite(3);
        $ligneFacturesdecembre219->setFacture($facturesdecembre219);
        $manager->persist($ligneFacturesdecembre219);
        $facturesdecembre219->addLigneFacture($ligneFacturesdecembre219);
        $manager->persist($facturesdecembre219);

        $facturesdecembre319 = new Facture();
        $facturesdecembre319->setConsultant($consultant3);
        $facturesdecembre319->setNumeroFacture("2019-12-0063");
        $facturesdecembre319->setDate(new \DateTime("21-12-2019"));
        $facturesdecembre319->setTypeDePaiement($type3);
        $facturesdecembre319->setNumeroChequeOuPaypal(45421548787);
        $manager->persist($facturesdecembre319);
        $ligneFacturesdecembre319 = new LigneFacture();
        $ligneFacturesdecembre319->setService($service9);
        $ligneFacturesdecembre319->setMontant(540);
        $ligneFacturesdecembre319->setQuantite(2);
        $ligneFacturesdecembre319->setFacture($facturesdecembre319);
        $manager->persist($ligneFacturesdecembre319);
        $facturesdecembre319->addLigneFacture($ligneFacturesdecembre319);
        $manager->persist($facturesdecembre319);


        //--------------------------------------------------------------------------------------
        //Création des Factures par mois 2020
        //--------------------------------------------------------------------------------------
        $facturejanvier20 = new Facture();
        $facturejanvier20->setConsultant($consultant1);
        $facturejanvier20->setNumeroFacture("2020-01-0120");
        $facturejanvier20->setDate(new \DateTime("07-01-2020"));
        $facturejanvier20->setTypeDePaiement($type1);
        $facturejanvier20->setNumeroChequeOuPaypal(45421548787);
        $manager->persist($facturejanvier20);
        $ligneFacturejanvier20 = new LigneFacture();
        $ligneFacturejanvier20->setService($service2);
        $ligneFacturejanvier20->setMontant(1800);
        $ligneFacturejanvier20->setQuantite(5);
        $ligneFacturejanvier20->setFacture($facturejanvier20);
        $manager->persist($ligneFacturejanvier20);
        $facturejanvier20->addLigneFacture($ligneFacturejanvier20);
        $manager->persist($facturejanvier20);


        $facturejanvier120 = new Facture();
        $facturejanvier120->setConsultant($consultant2);
        $facturejanvier120->setNumeroFacture("2020-01-0003");
        $facturejanvier120->setDate(new \DateTime("07-01-2020"));
        $facturejanvier120->setTypeDePaiement($type2);
        $facturejanvier120->setNumeroChequeOuPaypal(1378912348577);
        $manager->persist($facturejanvier120);
        $ligneFacturejanvier120 = new LigneFacture();
        $ligneFacturejanvier120->setService($service3);
        $ligneFacturejanvier120->setMontant(250);
        $ligneFacturejanvier120->setQuantite(2);
        $ligneFacturejanvier120->setFacture($facturejanvier120);
        $manager->persist($ligneFacturejanvier120);
        $facturejanvier120->addLigneFacture($ligneFacturejanvier120);
        $manager->persist($facturejanvier120);


        $facturejanvier220 = new Facture();
        $facturejanvier220->setConsultant($consultant3);
        $facturejanvier220->setNumeroFacture("2020-01-0006");
        $facturejanvier220->setDate(new \DateTime("11-01-2020"));
        $facturejanvier220->setTypeDePaiement($type3);
        $facturejanvier220->setNumeroChequeOuPaypal(null);
        $manager->persist($facturejanvier220);
        $ligneFacturejanvier220 = new LigneFacture();
        $ligneFacturejanvier220 ->setService($service1);
        $ligneFacturejanvier220->setMontant(90);
        $ligneFacturejanvier220->setQuantite(1);
        $ligneFacturejanvier220->setFacture($facturejanvier220);
        $manager->persist($ligneFacturejanvier220);
        $facturejanvier220->addLigneFacture($ligneFacturejanvier220);
        $manager->persist($facturejanvier220);


        $facturefevrier120 = new Facture();
        $facturefevrier120->setConsultant($consultant1);
        $facturefevrier120->setNumeroFacture("2020-02-0009");
        $facturefevrier120->setDate(new \DateTime("07-02-2020"));
        $facturefevrier120->setTypeDePaiement($type1);
        $facturefevrier120->setNumeroChequeOuPaypal(45421548787);
        $manager->persist($facturefevrier120);
        $ligneFacturefevrier120 = new LigneFacture();
        $ligneFacturefevrier120->setService($service4);
        $ligneFacturefevrier120->setMontant(426);
        $ligneFacturefevrier120->setQuantite(4);
        $ligneFacturefevrier120->setFacture($facturefevrier120);
        $manager->persist($ligneFacturefevrier120);
        $facturefevrier120->addLigneFacture($ligneFacturefevrier120);
        $manager->persist($facturefevrier120);

        $facturefevrier220 = new Facture();
        $facturefevrier220->setConsultant($consultant2);
        $facturefevrier220->setNumeroFacture("2020-02-0019");
        $facturefevrier220->setDate(new \DateTime("14-02-2020"));
        $facturefevrier220->setTypeDePaiement($type2);
        $facturefevrier220->setNumeroChequeOuPaypal(45421548787);
        $manager->persist($facturefevrier220);
        $ligneFacturefevrier220 = new LigneFacture();
        $ligneFacturefevrier220->setService($service5);
        $ligneFacturefevrier220->setMontant(376);
        $ligneFacturefevrier220->setQuantite(2);
        $ligneFacturefevrier220->setFacture($facturefevrier220);
        $manager->persist($ligneFacturefevrier220);
        $facturefevrier220->addLigneFacture($ligneFacturefevrier220);
        $manager->persist($facturefevrier220);


        $facturefevrier320 = new Facture();
        $facturefevrier320->setConsultant($consultant3);
        $facturefevrier320->setNumeroFacture("2020-02-0007");
        $facturefevrier320->setDate(new \DateTime("21-02-2020"));
        $facturefevrier320->setTypeDePaiement($type3);
        $facturefevrier320->setNumeroChequeOuPaypal(45421548787);
        $manager->persist($facturefevrier320);
        $ligneFacturefevrier320 = new LigneFacture();
        $ligneFacturefevrier320->setService($service6);
        $ligneFacturefevrier320->setMontant(776);
        $ligneFacturefevrier320->setQuantite(4);
        $ligneFacturefevrier320->setFacture($facturefevrier320);
        $manager->persist($ligneFacturefevrier320);
        $facturefevrier320->addLigneFacture($ligneFacturefevrier320);
        $manager->persist($facturefevrier320);


        $facturemars120 = new Facture();
        $facturemars120->setConsultant($consultant1);
        $facturemars120->setNumeroFacture("2020-03-0013");
        $facturemars120->setDate(new \DateTime("07-03-2020"));
        $facturemars120->setTypeDePaiement($type1);
        $facturemars120->setNumeroChequeOuPaypal(45421548787);
        $manager->persist($facturemars120);
        $ligneFacturemars120 = new LigneFacture();
        $ligneFacturemars120->setService($service7);
        $ligneFacturemars120->setMontant(376);
        $ligneFacturemars120->setQuantite(2);
        $ligneFacturemars120->setFacture($facturemars120);
        $manager->persist($ligneFacturemars120);
        $facturemars120->addLigneFacture($ligneFacturemars120);
        $manager->persist($facturemars120);

        $facturemars220 = new Facture();
        $facturemars220->setConsultant($consultant2);
        $facturemars220->setNumeroFacture("2020-03-0023");
        $facturemars220->setDate(new \DateTime("14-03-2020"));
        $facturemars220->setTypeDePaiement($type2);
        $facturemars220->setNumeroChequeOuPaypal(45421548787);
        $manager->persist($facturemars220);
        $ligneFacturemars220 = new LigneFacture();
        $ligneFacturemars220->setService($service8);
        $ligneFacturemars220->setMontant(899);
        $ligneFacturemars220->setQuantite(3);
        $ligneFacturemars220->setFacture($facturemars220);
        $manager->persist($ligneFacturemars220);
        $facturemars220->addLigneFacture($ligneFacturemars220);
        $manager->persist($facturemars220);

        $facturemars320 = new Facture();
        $facturemars320->setConsultant($consultant3);
        $facturemars320->setNumeroFacture("2020-03-0063");
        $facturemars320->setDate(new \DateTime("21-03-2020"));
        $facturemars320->setTypeDePaiement($type3);
        $facturemars320->setNumeroChequeOuPaypal(45421548787);
        $manager->persist($facturemars320);
        $ligneFacturemars320 = new LigneFacture();
        $ligneFacturemars320->setService($service9);
        $ligneFacturemars320->setMontant(540);
        $ligneFacturemars320->setQuantite(2);
        $ligneFacturemars320->setFacture($facturemars320);
        $manager->persist($ligneFacturemars320);
        $facturemars320->addLigneFacture($ligneFacturemars320);
        $manager->persist($facturemars320);


        $factureavril120 = new Facture();
        $factureavril120->setConsultant($consultant1);
        $factureavril120->setNumeroFacture("2020-04-0013");
        $factureavril120->setDate(new \DateTime("07-04-2020"));
        $factureavril120->setTypeDePaiement($type1);
        $factureavril120->setNumeroChequeOuPaypal(45421548787);
        $manager->persist($factureavril120);
        $ligneFactureavril120 = new LigneFacture();
        $ligneFactureavril120->setService($service7);
        $ligneFactureavril120->setMontant(376);
        $ligneFactureavril120->setQuantite(2);
        $ligneFactureavril120->setFacture($factureavril120);
        $manager->persist($ligneFactureavril120);
        $factureavril120->addLigneFacture($ligneFactureavril120);
        $manager->persist($factureavril120);

        $factureavril220 = new Facture();
        $factureavril220->setConsultant($consultant2);
        $factureavril220->setNumeroFacture("2020-04-0023");
        $factureavril220->setDate(new \DateTime("14-04-2020"));
        $factureavril220->setTypeDePaiement($type2);
        $factureavril220->setNumeroChequeOuPaypal(45421548787);
        $manager->persist($factureavril220);
        $ligneFactureavril220 = new LigneFacture();
        $ligneFactureavril220->setService($service8);
        $ligneFactureavril220->setMontant(899);
        $ligneFactureavril220->setQuantite(3);
        $ligneFactureavril220->setFacture($factureavril220);
        $manager->persist($ligneFactureavril220);
        $factureavril220->addLigneFacture($ligneFactureavril220);
        $manager->persist($factureavril220);

        $factureavril320 = new Facture();
        $factureavril320->setConsultant($consultant3);
        $factureavril320->setNumeroFacture("2020-04-0063");
        $factureavril320->setDate(new \DateTime("21-04-2020"));
        $factureavril320->setTypeDePaiement($type3);
        $factureavril320->setNumeroChequeOuPaypal(45421548787);
        $manager->persist($factureavril320);
        $ligneFactureavril320 = new LigneFacture();
        $ligneFactureavril320->setService($service9);
        $ligneFactureavril320->setMontant(540);
        $ligneFactureavril320->setQuantite(2);
        $ligneFactureavril320->setFacture($factureavril320);
        $manager->persist($ligneFactureavril320);
        $factureavril320->addLigneFacture($ligneFactureavril320);
        $manager->persist($factureavril320);


        $facturemai120 = new Facture();
        $facturemai120->setConsultant($consultant1);
        $facturemai120->setNumeroFacture("2020-05-0013");
        $facturemai120->setDate(new \DateTime("07-05-2020"));
        $facturemai120->setTypeDePaiement($type1);
        $facturemai120->setNumeroChequeOuPaypal(45421548787);
        $manager->persist($facturemai120);
        $ligneFacturemai120 = new LigneFacture();
        $ligneFacturemai120->setService($service7);
        $ligneFacturemai120->setMontant(376);
        $ligneFacturemai120->setQuantite(2);
        $ligneFacturemai120->setFacture($facturemai120);
        $manager->persist($ligneFacturemai120);
        $facturemai120->addLigneFacture($ligneFacturemai120);
        $manager->persist($facturemai120);

        $facturemai220 = new Facture();
        $facturemai220->setConsultant($consultant2);
        $facturemai220->setNumeroFacture("2020-05-0023");
        $facturemai220->setDate(new \DateTime("14-05-2020"));
        $facturemai220->setTypeDePaiement($type2);
        $facturemai220->setNumeroChequeOuPaypal(45421548787);
        $manager->persist($facturemai220);
        $ligneFacturemai220 = new LigneFacture();
        $ligneFacturemai220->setService($service8);
        $ligneFacturemai220->setMontant(899);
        $ligneFacturemai220->setQuantite(3);
        $ligneFacturemai220->setFacture($factureavril220);
        $manager->persist($ligneFacturemai220);
        $facturemai220->addLigneFacture($ligneFacturemai220);
        $manager->persist($facturemai220);

        $facturemai320 = new Facture();
        $facturemai320->setConsultant($consultant3);
        $facturemai320->setNumeroFacture("2020-05-0063");
        $facturemai320->setDate(new \DateTime("21-05-2020"));
        $facturemai320->setTypeDePaiement($type3);
        $facturemai320->setNumeroChequeOuPaypal(45421548787);
        $manager->persist($facturemai320);
        $ligneFacturemai320 = new LigneFacture();
        $ligneFacturemai320->setService($service9);
        $ligneFacturemai320->setMontant(540);
        $ligneFacturemai320->setQuantite(2);
        $ligneFacturemai320->setFacture($facturemai320);
        $manager->persist($ligneFacturemai320);
        $facturemai320->addLigneFacture($ligneFacturemai320);
        $manager->persist($facturemai320);



        $facturejuin120 = new Facture();
        $facturejuin120->setConsultant($consultant1);
        $facturejuin120->setNumeroFacture("2020-06-0013");
        $facturejuin120->setDate(new \DateTime("07-06-2020"));
        $facturejuin120->setTypeDePaiement($type1);
        $facturejuin120->setNumeroChequeOuPaypal(45421548787);
        $manager->persist($facturejuin120);
        $ligneFacturejuin120 = new LigneFacture();
        $ligneFacturejuin120->setService($service7);
        $ligneFacturejuin120->setMontant(376);
        $ligneFacturejuin120->setQuantite(2);
        $ligneFacturejuin120->setFacture($facturejuin120);
        $manager->persist($ligneFacturejuin120);
        $facturejuin120->addLigneFacture($ligneFacturejuin120);
        $manager->persist($facturejuin120);

        $facturejuin220 = new Facture();
        $facturejuin220->setConsultant($consultant2);
        $facturejuin220->setNumeroFacture("2020-06-0023");
        $facturejuin220->setDate(new \DateTime("14-06-2020"));
        $facturejuin220->setTypeDePaiement($type2);
        $facturejuin220->setNumeroChequeOuPaypal(45421548787);
        $manager->persist($facturejuin220);
        $ligneFacturejuin220 = new LigneFacture();
        $ligneFacturejuin220->setService($service8);
        $ligneFacturejuin220->setMontant(899);
        $ligneFacturejuin220->setQuantite(3);
        $ligneFacturejuin220->setFacture($facturejuin220);
        $manager->persist($ligneFacturejuin220);
        $facturejuin220->addLigneFacture($ligneFacturejuin220);
        $manager->persist($facturejuin220);

        $facturejuin320 = new Facture();
        $facturejuin320->setConsultant($consultant3);
        $facturejuin320->setNumeroFacture("2020-06-0063");
        $facturejuin320->setDate(new \DateTime("21-06-2020"));
        $facturejuin320->setTypeDePaiement($type3);
        $facturejuin320->setNumeroChequeOuPaypal(45421548787);
        $manager->persist($facturejuin320);
        $ligneFacturejuin320 = new LigneFacture();
        $ligneFacturejuin320->setService($service9);
        $ligneFacturejuin320->setMontant(540);
        $ligneFacturejuin320->setQuantite(2);
        $ligneFacturejuin320->setFacture($facturejuin320);
        $manager->persist($ligneFacturejuin320);
        $facturejuin320->addLigneFacture($ligneFacturejuin320);
        $manager->persist($facturejuin320);



        $facturejuillet120 = new Facture();
        $facturejuillet120->setConsultant($consultant1);
        $facturejuillet120->setNumeroFacture("2020-07-0013");
        $facturejuillet120->setDate(new \DateTime("07-07-2020"));
        $facturejuillet120->setTypeDePaiement($type1);
        $facturejuillet120->setNumeroChequeOuPaypal(45421548787);
        $manager->persist($facturejuillet120);
        $ligneFacturejuillet120 = new LigneFacture();
        $ligneFacturejuillet120->setService($service7);
        $ligneFacturejuillet120->setMontant(376);
        $ligneFacturejuillet120->setQuantite(2);
        $ligneFacturejuillet120->setFacture($facturejuillet120);
        $manager->persist($ligneFacturejuillet120);
        $facturejuillet120->addLigneFacture($ligneFacturejuillet120);
        $manager->persist($facturejuillet120);

        $facturejuillet220 = new Facture();
        $facturejuillet220->setConsultant($consultant2);
        $facturejuillet220->setNumeroFacture("2020-07-0023");
        $facturejuillet220->setDate(new \DateTime("14-07-2020"));
        $facturejuillet220->setTypeDePaiement($type2);
        $facturejuillet220->setNumeroChequeOuPaypal(45421548787);
        $manager->persist($facturejuillet220);
        $ligneFacturejuillet220 = new LigneFacture();
        $ligneFacturejuillet220->setService($service8);
        $ligneFacturejuillet220->setMontant(899);
        $ligneFacturejuillet220->setQuantite(3);
        $ligneFacturejuillet220->setFacture($facturejuillet220);
        $manager->persist($ligneFacturejuillet220);
        $facturejuillet220->addLigneFacture($ligneFacturejuillet220);
        $manager->persist($facturejuillet220);

        $facturejuillet320 = new Facture();
        $facturejuillet320->setConsultant($consultant3);
        $facturejuillet320->setNumeroFacture("2020-07-0063");
        $facturejuillet320->setDate(new \DateTime("21-07-2020"));
        $facturejuillet320->setTypeDePaiement($type3);
        $facturejuillet320->setNumeroChequeOuPaypal(45421548787);
        $manager->persist($facturejuillet320);
        $ligneFacturejuillet320 = new LigneFacture();
        $ligneFacturejuillet320->setService($service9);
        $ligneFacturejuillet320->setMontant(540);
        $ligneFacturejuillet320->setQuantite(2);
        $ligneFacturejuillet320->setFacture($facturejuillet320);
        $manager->persist($ligneFacturejuillet320);
        $facturejuillet320->addLigneFacture($ligneFacturejuillet320);
        $manager->persist($facturejuillet320);




        $factureaout120 = new Facture();
        $factureaout120->setConsultant($consultant1);
        $factureaout120->setNumeroFacture("2020-08-0013");
        $factureaout120->setDate(new \DateTime("07-08-2020"));
        $factureaout120->setTypeDePaiement($type1);
        $factureaout120->setNumeroChequeOuPaypal(45421548787);
        $manager->persist($factureaout120);
        $ligneFactureaout120 = new LigneFacture();
        $ligneFactureaout120->setService($service7);
        $ligneFactureaout120->setMontant(376);
        $ligneFactureaout120->setQuantite(2);
        $ligneFactureaout120->setFacture($factureaout120);
        $manager->persist($ligneFactureaout120);
        $factureaout120->addLigneFacture($ligneFactureaout120);
        $manager->persist($factureaout120);

        $factureaout220 = new Facture();
        $factureaout220->setConsultant($consultant2);
        $factureaout220->setNumeroFacture("2020-08-0023");
        $factureaout220->setDate(new \DateTime("14-08-2020"));
        $factureaout220->setTypeDePaiement($type2);
        $factureaout220->setNumeroChequeOuPaypal(45421548787);
        $manager->persist($factureaout220);
        $ligneFactureaout220 = new LigneFacture();
        $ligneFactureaout220->setService($service8);
        $ligneFactureaout220->setMontant(899);
        $ligneFactureaout220->setQuantite(3);
        $ligneFactureaout220->setFacture($factureaout220);
        $manager->persist($ligneFactureaout220);
        $factureaout220->addLigneFacture($ligneFactureaout220);
        $manager->persist($factureaout220);

        $facturesaout320 = new Facture();
        $facturesaout320->setConsultant($consultant3);
        $facturesaout320->setNumeroFacture("2020-08-0063");
        $facturesaout320->setDate(new \DateTime("21-08-2020"));
        $facturesaout320->setTypeDePaiement($type3);
        $facturesaout320->setNumeroChequeOuPaypal(45421548787);
        $manager->persist($facturesaout320);
        $ligneFactureaout320 = new LigneFacture();
        $ligneFactureaout320->setService($service9);
        $ligneFactureaout320->setMontant(540);
        $ligneFactureaout320->setQuantite(2);
        $ligneFactureaout320->setFacture($facturesaout320);
        $manager->persist($ligneFactureaout320);
        $facturesaout320->addLigneFacture($ligneFactureaout320);
        $manager->persist($facturesaout320);






        $facturesseptembre120 = new Facture();
        $facturesseptembre120->setConsultant($consultant1);
        $facturesseptembre120->setNumeroFacture("2020-09-0013");
        $facturesseptembre120->setDate(new \DateTime("07-09-2020"));
        $facturesseptembre120->setTypeDePaiement($type1);
        $facturesseptembre120->setNumeroChequeOuPaypal(45421548787);
        $manager->persist($facturesseptembre120);
        $ligneFacturesseptembre120 = new LigneFacture();
        $ligneFacturesseptembre120->setService($service7);
        $ligneFacturesseptembre120->setMontant(376);
        $ligneFacturesseptembre120->setQuantite(2);
        $ligneFacturesseptembre120->setFacture($facturesseptembre120);
        $manager->persist($ligneFacturesseptembre120);
        $facturesseptembre120->addLigneFacture($ligneFacturesseptembre120);
        $manager->persist($facturesseptembre120);

        $facturesseptembre220 = new Facture();
        $facturesseptembre220->setConsultant($consultant2);
        $facturesseptembre220->setNumeroFacture("2020-09-0023");
        $facturesseptembre220->setDate(new \DateTime("14-09-2020"));
        $facturesseptembre220->setTypeDePaiement($type2);
        $facturesseptembre220->setNumeroChequeOuPaypal(45421548787);
        $manager->persist($facturesseptembre220);
        $ligneFacturesseptembre220 = new LigneFacture();
        $ligneFacturesseptembre220->setService($service8);
        $ligneFacturesseptembre220->setMontant(899);
        $ligneFacturesseptembre220->setQuantite(3);
        $ligneFacturesseptembre220->setFacture($facturesseptembre220);
        $manager->persist($ligneFacturesseptembre220);
        $facturesseptembre220->addLigneFacture($ligneFacturesseptembre220);
        $manager->persist($facturesseptembre220);

        $facturesseptembre320 = new Facture();
        $facturesseptembre320->setConsultant($consultant3);
        $facturesseptembre320->setNumeroFacture("2020-09-0063");
        $facturesseptembre320->setDate(new \DateTime("21-09-2020"));
        $facturesseptembre320->setTypeDePaiement($type3);
        $facturesseptembre320->setNumeroChequeOuPaypal(45421548787);
        $manager->persist($facturesseptembre320);
        $ligneFacturesseptembre320 = new LigneFacture();
        $ligneFacturesseptembre320->setService($service9);
        $ligneFacturesseptembre320->setMontant(540);
        $ligneFacturesseptembre320->setQuantite(2);
        $ligneFacturesseptembre320->setFacture($facturesseptembre320);
        $manager->persist($ligneFacturesseptembre320);
        $facturesseptembre320->addLigneFacture($ligneFacturesseptembre320);
        $manager->persist($facturesseptembre320);







        $facturesoctobre120 = new Facture();
        $facturesoctobre120->setConsultant($consultant1);
        $facturesoctobre120->setNumeroFacture("2020-10-0013");
        $facturesoctobre120->setDate(new \DateTime("07-10-2020"));
        $facturesoctobre120->setTypeDePaiement($type1);
        $facturesoctobre120->setNumeroChequeOuPaypal(45421548787);
        $manager->persist($facturesoctobre120);
        $ligneFactureoctobre120 = new LigneFacture();
        $ligneFactureoctobre120->setService($service7);
        $ligneFactureoctobre120->setMontant(376);
        $ligneFactureoctobre120->setQuantite(2);
        $ligneFactureoctobre120->setFacture($facturesoctobre120);
        $manager->persist($ligneFactureoctobre120);
        $facturesoctobre120->addLigneFacture($ligneFactureoctobre120);
        $manager->persist($facturesoctobre120);

        $facturesoctobre220 = new Facture();
        $facturesoctobre220->setConsultant($consultant2);
        $facturesoctobre220->setNumeroFacture("2020-10-0023");
        $facturesoctobre220->setDate(new \DateTime("14-10-2020"));
        $facturesoctobre220->setTypeDePaiement($type2);
        $facturesoctobre220->setNumeroChequeOuPaypal(45421548787);
        $manager->persist($facturesoctobre220);
        $ligneFacturesoctobre220 = new LigneFacture();
        $ligneFacturesoctobre220->setService($service8);
        $ligneFacturesoctobre220->setMontant(899);
        $ligneFacturesoctobre220->setQuantite(3);
        $ligneFacturesoctobre220->setFacture($facturesoctobre220);
        $manager->persist($ligneFacturesoctobre220);
        $facturesoctobre220->addLigneFacture($ligneFacturesoctobre220);
        $manager->persist($facturesoctobre220);

        $facturesoctobre320 = new Facture();
        $facturesoctobre320->setConsultant($consultant3);
        $facturesoctobre320->setNumeroFacture("2020-10-0063");
        $facturesoctobre320->setDate(new \DateTime("21-10-2020"));
        $facturesoctobre320->setTypeDePaiement($type3);
        $facturesoctobre320->setNumeroChequeOuPaypal(45421548787);
        $manager->persist($facturesoctobre320);
        $ligneFacturesoctobre320 = new LigneFacture();
        $ligneFacturesoctobre320->setService($service9);
        $ligneFacturesoctobre320->setMontant(540);
        $ligneFacturesoctobre320->setQuantite(2);
        $ligneFacturesoctobre320->setFacture($facturesoctobre320);
        $manager->persist($ligneFacturesoctobre320);
        $facturesoctobre320->addLigneFacture($ligneFacturesoctobre320);
        $manager->persist($facturesoctobre320);





        $facturesnovembre120 = new Facture();
        $facturesnovembre120->setConsultant($consultant1);
        $facturesnovembre120->setNumeroFacture("2020-11-0013");
        $facturesnovembre120->setDate(new \DateTime("07-11-2020"));
        $facturesnovembre120->setTypeDePaiement($type1);
        $facturesnovembre120->setNumeroChequeOuPaypal(45421548787);
        $manager->persist($facturesnovembre120);
        $ligneFacturesnovembre120 = new LigneFacture();
        $ligneFacturesnovembre120->setService($service7);
        $ligneFacturesnovembre120->setMontant(376);
        $ligneFacturesnovembre120->setQuantite(2);
        $ligneFacturesnovembre120->setFacture($facturesnovembre120);
        $manager->persist($ligneFacturesnovembre120);
        $facturesnovembre120->addLigneFacture($ligneFacturesnovembre120);
        $manager->persist($facturesnovembre120);

        $facturesnovembre220 = new Facture();
        $facturesnovembre220->setConsultant($consultant2);
        $facturesnovembre220->setNumeroFacture("2020-11-0023");
        $facturesnovembre220->setDate(new \DateTime("14-11-2020"));
        $facturesnovembre220->setTypeDePaiement($type2);
        $facturesnovembre220->setNumeroChequeOuPaypal(45421548787);
        $manager->persist($facturesnovembre220);
        $ligneFacturesnovembre220 = new LigneFacture();
        $ligneFacturesnovembre220->setService($service8);
        $ligneFacturesnovembre220->setMontant(899);
        $ligneFacturesnovembre220->setQuantite(3);
        $ligneFacturesnovembre220->setFacture($facturesnovembre220);
        $manager->persist($ligneFacturesnovembre220);
        $facturesnovembre220->addLigneFacture($ligneFacturesnovembre220);
        $manager->persist($facturesnovembre220);

        $facturesnovembre320 = new Facture();
        $facturesnovembre320->setConsultant($consultant3);
        $facturesnovembre320->setNumeroFacture("2020-11-0063");
        $facturesnovembre320->setDate(new \DateTime("21-11-2020"));
        $facturesnovembre320->setTypeDePaiement($type3);
        $facturesnovembre320->setNumeroChequeOuPaypal(45421548787);
        $manager->persist($facturesnovembre320);
        $ligneFacturesnovembre320 = new LigneFacture();
        $ligneFacturesnovembre320->setService($service9);
        $ligneFacturesnovembre320->setMontant(540);
        $ligneFacturesnovembre320->setQuantite(2);
        $ligneFacturesnovembre320->setFacture($facturesnovembre320);
        $manager->persist($ligneFacturesnovembre320);
        $facturesnovembre320->addLigneFacture($ligneFacturesnovembre320);
        $manager->persist($facturesnovembre320);





        $facturesdecembre120 = new Facture();
        $facturesdecembre120->setConsultant($consultant1);
        $facturesdecembre120->setNumeroFacture("2020-12-0013");
        $facturesdecembre120->setDate(new \DateTime("07-12-2020"));
        $facturesdecembre120->setTypeDePaiement($type1);
        $facturesdecembre120->setNumeroChequeOuPaypal(45421548787);
        $manager->persist($facturesdecembre120);
        $ligneFacturedecembre120 = new LigneFacture();
        $ligneFacturedecembre120->setService($service7);
        $ligneFacturedecembre120->setMontant(376);
        $ligneFacturedecembre120->setQuantite(2);
        $ligneFacturedecembre120->setFacture($facturesdecembre120);
        $manager->persist($ligneFacturedecembre120);
        $facturesdecembre120->addLigneFacture($ligneFacturedecembre120);
        $manager->persist($facturesdecembre120);

        $facturesdecembre220 = new Facture();
        $facturesdecembre220->setConsultant($consultant2);
        $facturesdecembre220->setNumeroFacture("2020-12-0023");
        $facturesdecembre220->setDate(new \DateTime("14-12-2020"));
        $facturesdecembre220->setTypeDePaiement($type2);
        $facturesdecembre220->setNumeroChequeOuPaypal(45421548787);
        $manager->persist($facturesdecembre220);
        $ligneFacturesdecembre220 = new LigneFacture();
        $ligneFacturesdecembre220->setService($service8);
        $ligneFacturesdecembre220->setMontant(899);
        $ligneFacturesdecembre220->setQuantite(3);
        $ligneFacturesdecembre220->setFacture($facturesdecembre220);
        $manager->persist($ligneFacturesdecembre220);
        $facturesdecembre220->addLigneFacture($ligneFacturesdecembre220);
        $manager->persist($facturesdecembre220);

        $facturesdecembre320 = new Facture();
        $facturesdecembre320->setConsultant($consultant3);
        $facturesdecembre320->setNumeroFacture("2020-12-0063");
        $facturesdecembre320->setDate(new \DateTime("21-12-2020"));
        $facturesdecembre320->setTypeDePaiement($type3);
        $facturesdecembre320->setNumeroChequeOuPaypal(45421548787);
        $manager->persist($facturesdecembre320);
        $ligneFacturesdecembre320 = new LigneFacture();
        $ligneFacturesdecembre320->setService($service9);
        $ligneFacturesdecembre320->setMontant(540);
        $ligneFacturesdecembre320->setQuantite(2);
        $ligneFacturesdecembre320->setFacture($facturesdecembre320);
        $manager->persist($ligneFacturesdecembre320);
        $facturesdecembre320->addLigneFacture($ligneFacturesdecembre320);
        $manager->persist($facturesdecembre320);






        //--------------------------------------------------------------------------------------
        //Création des Factures par mois 2021
        //--------------------------------------------------------------------------------------

        $facturejanvier1 = new Facture();
        $facturejanvier1->setConsultant($consultant1);
        $facturejanvier1->setNumeroFacture("2021-01-0001");
        $facturejanvier1->setDate(new \DateTime("07-01-2021"));
        $facturejanvier1->setTypeDePaiement($type1);
        $facturejanvier1->setNumeroChequeOuPaypal(45421548787);
        $manager->persist($facturejanvier1);
        $ligneFacturejanvier1 = new LigneFacture();
        $ligneFacturejanvier1->setQuantite(1);
        $ligneFacturejanvier1->setMontant(230);
        $ligneFacturejanvier1->setService($service1);
        $ligneFacturejanvier1->setFacture($facturejanvier1);
        $manager->persist($ligneFacturejanvier1);
        $facturejanvier1->addLigneFacture($ligneFacturejanvier1);

        $manager->persist($facturejanvier1);


        $facturejanvier2 = new Facture();
        $facturejanvier2->setConsultant($consultant2);
        $facturejanvier2->setNumeroFacture("2021-01-0003");
        $facturejanvier2->setDate(new \DateTime("07-01-2021"));
        $facturejanvier2->setTypeDePaiement($type2);
        $facturejanvier2->setNumeroChequeOuPaypal(1378912348577);
        $manager->persist($facturejanvier2);
        $ligneFacturejanvier2 = new LigneFacture();
        $ligneFacturejanvier2->setQuantite(2);
        $ligneFacturejanvier2->setMontant(510);
        $ligneFacturejanvier2->setService($service9);
        $ligneFacturejanvier2->setFacture($facturejanvier2);
        $manager->persist($ligneFacturejanvier2);
        $facturejanvier2->addLigneFacture($ligneFacturejanvier2);
        $manager->persist($facturejanvier2);


        $facturejanvier3 = new Facture();
        $facturejanvier3->setConsultant($consultant3);
        $facturejanvier3->setNumeroFacture("2021-01-0006");
        $facturejanvier3->setDate(new \DateTime("11-01-2021"));
        $facturejanvier3->setTypeDePaiement($type3);
        $facturejanvier3->setNumeroChequeOuPaypal(null);
        $manager->persist($facturejanvier3);
        $ligneFacturejanvier3 = new LigneFacture();
        $ligneFacturejanvier3->setQuantite(2);
        $ligneFacturejanvier3->setMontant(456);
        $ligneFacturejanvier3->setService($service3);
        $ligneFacturejanvier3->setFacture($facturejanvier3);
        $manager->persist($ligneFacturejanvier3);
        $facturejanvier3->addLigneFacture($ligneFacturejanvier3);
        $manager->persist($facturejanvier3);


        $facturefevrier1 = new Facture();
        $facturefevrier1->setConsultant($consultant1);
        $facturefevrier1->setNumeroFacture("2021-02-0009");
        $facturefevrier1->setDate(new \DateTime("07-02-2021"));
        $facturefevrier1->setTypeDePaiement($type1);
        $facturefevrier1->setNumeroChequeOuPaypal(45421548787);
        $manager->persist($facturefevrier1);
        $ligneFacturefevrier1 = new LigneFacture();
        $ligneFacturefevrier1->setQuantite(2);
        $ligneFacturefevrier1->setMontant(330);
        $ligneFacturefevrier1->setService($service1);
        $ligneFacturefevrier1->setFacture($facturefevrier1);
        $manager->persist($ligneFacturefevrier1);
        $facturefevrier1->addLigneFacture($ligneFacturefevrier1);
        $manager->persist($facturefevrier1);


        $facturefevrier2 = new Facture();
        $facturefevrier2->setConsultant($consultant2);
        $facturefevrier2->setNumeroFacture("2021-02-0019");
        $facturefevrier2->setDate(new \DateTime("14-02-2021"));
        $facturefevrier2->setTypeDePaiement($type2);
        $facturefevrier2->setNumeroChequeOuPaypal(45421548787);
        $manager->persist($facturefevrier2);
        $ligneFacturefevrier2 = new LigneFacture();
        $ligneFacturefevrier2->setMontant(660);
        $ligneFacturefevrier2->setQuantite(3);
        $ligneFacturefevrier2->setService($service8);
        $ligneFacturefevrier2->setFacture($facturefevrier2);
        $manager->persist($ligneFacturefevrier2);
        $facturefevrier2->addLigneFacture($ligneFacturefevrier2);
        $manager->persist($facturefevrier2);

        $facturefevrier3 = new Facture();
        $facturefevrier3->setConsultant($consultant3);
        $facturefevrier3->setNumeroFacture("2021-02-0007");
        $facturefevrier3->setDate(new \DateTime("21-02-2021"));
        $facturefevrier3->setTypeDePaiement($type3);
        $facturefevrier3->setNumeroChequeOuPaypal(45421548787);
        $manager->persist($facturefevrier3);
        $ligneFacturefevrier3 = new LigneFacture();
        $ligneFacturefevrier3->setQuantite(3);
        $ligneFacturefevrier3->setMontant(400);
        $ligneFacturefevrier3->setService($service5);
        $ligneFacturefevrier3->setFacture($facturefevrier3);
        $manager->persist($ligneFacturefevrier3);
        $facturefevrier3->addLigneFacture($ligneFacturefevrier3);
        $manager->persist($facturefevrier3);


        $facturemars1 = new Facture();
        $facturemars1->setConsultant($consultant1);
        $facturemars1->setNumeroFacture("2021-03-0013");
        $facturemars1->setDate(new \DateTime("07-03-2021"));
        $facturemars1->setTypeDePaiement($type1);
        $facturemars1->setNumeroChequeOuPaypal(45421548787);
        $manager->persist($facturemars1);
        $ligneFacturemars1 = new LigneFacture();
        $ligneFacturemars1->setQuantite(3);
        $ligneFacturemars1->setMontant(745);
        $ligneFacturemars1->setService($service6);
        $ligneFacturemars1->setFacture($facturemars1);
        $manager->persist($ligneFacturemars1);
        $facturemars1->addLigneFacture($ligneFacturemars1);
        $manager->persist($facturemars1);

        $facturemars2 = new Facture();
        $facturemars2->setConsultant($consultant2);
        $facturemars2->setNumeroFacture("2021-03-0023");
        $facturemars2->setDate(new \DateTime("14-03-2021"));
        $facturemars2->setTypeDePaiement($type2);
        $facturemars2->setNumeroChequeOuPaypal(45421548787);
        $manager->persist($facturemars2);
        $ligneFacturemars2 = new LigneFacture();
        $ligneFacturemars2->setQuantite(1);
        $ligneFacturemars2->setMontant(300);
        $ligneFacturemars2->setService($service2);
        $ligneFacturemars2->setFacture($facturemars2);
        $manager->persist($ligneFacturemars2);
        $facturemars2->addLigneFacture($ligneFacturemars2);
        $manager->persist($facturemars2);

        $facturemars3 = new Facture();
        $facturemars3->setConsultant($consultant3);
        $facturemars3->setNumeroFacture("2021-03-0063");
        $facturemars3->setDate(new \DateTime("21-03-2021"));
        $facturemars3->setTypeDePaiement($type3);
        $facturemars3->setNumeroChequeOuPaypal(45421548787);
        $manager->persist($facturemars3);
        $ligneFacturemars3 = new LigneFacture();
        $ligneFacturemars3->setQuantite(1);
        $ligneFacturemars3->setMontant(300);
        $ligneFacturemars3->setService($service2);
        $ligneFacturemars3->setFacture($facturemars3);
        $manager->persist($ligneFacturemars3);
        $facturemars3->addLigneFacture($ligneFacturemars3);
        $manager->persist($facturemars3);




        $factureavril121 = new Facture();
        $factureavril121->setConsultant($consultant1);
        $factureavril121->setNumeroFacture("2021-04-0013");
        $factureavril121->setDate(new \DateTime("07-04-2021"));
        $factureavril121->setTypeDePaiement($type1);
        $factureavril121->setNumeroChequeOuPaypal(45421548787);
        $manager->persist($factureavril121);
        $ligneFactureavril121 = new LigneFacture();
        $ligneFactureavril121->setService($service7);
        $ligneFactureavril121->setMontant(376);
        $ligneFactureavril121->setQuantite(2);
        $ligneFactureavril121->setFacture($factureavril121);
        $manager->persist($ligneFactureavril121);
        $factureavril121->addLigneFacture($ligneFactureavril121);
        $manager->persist($factureavril121);

        $factureavril221 = new Facture();
        $factureavril221->setConsultant($consultant2);
        $factureavril221->setNumeroFacture("2021-04-0023");
        $factureavril221->setDate(new \DateTime("14-04-2021"));
        $factureavril221->setTypeDePaiement($type2);
        $factureavril221->setNumeroChequeOuPaypal(45421548787);
        $manager->persist($factureavril221);
        $ligneFactureavril221 = new LigneFacture();
        $ligneFactureavril221->setService($service8);
        $ligneFactureavril221->setMontant(899);
        $ligneFactureavril221->setQuantite(3);
        $ligneFactureavril221->setFacture($factureavril221);
        $manager->persist($ligneFactureavril221);
        $factureavril221->addLigneFacture($ligneFactureavril221);
        $manager->persist($factureavril221);

        $factureavril321 = new Facture();
        $factureavril321->setConsultant($consultant3);
        $factureavril321->setNumeroFacture("2021-04-0063");
        $factureavril321->setDate(new \DateTime("21-04-2021"));
        $factureavril321->setTypeDePaiement($type3);
        $factureavril321->setNumeroChequeOuPaypal(45421548787);
        $manager->persist($factureavril321);
        $ligneFactureavril321 = new LigneFacture();
        $ligneFactureavril321->setService($service9);
        $ligneFactureavril321->setMontant(540);
        $ligneFactureavril321->setQuantite(2);
        $ligneFactureavril321->setFacture($factureavril321);
        $manager->persist($ligneFactureavril321);
        $factureavril321->addLigneFacture($ligneFactureavril321);
        $manager->persist($factureavril321);


        $facturemai121 = new Facture();
        $facturemai121->setConsultant($consultant1);
        $facturemai121->setNumeroFacture("2021-05-0013");
        $facturemai121->setDate(new \DateTime("07-05-2021"));
        $facturemai121->setTypeDePaiement($type1);
        $facturemai121->setNumeroChequeOuPaypal(45421548787);
        $manager->persist($facturemai121);
        $ligneFacturemai121 = new LigneFacture();
        $ligneFacturemai121->setService($service7);
        $ligneFacturemai121->setMontant(376);
        $ligneFacturemai121->setQuantite(2);
        $ligneFacturemai121->setFacture($facturemai121);
        $manager->persist($ligneFacturemai121);
        $facturemai121->addLigneFacture($ligneFacturemai121);
        $manager->persist($facturemai121);

        $facturemai221 = new Facture();
        $facturemai221->setConsultant($consultant2);
        $facturemai221->setNumeroFacture("2021-05-0023");
        $facturemai221->setDate(new \DateTime("14-05-2021"));
        $facturemai221->setTypeDePaiement($type2);
        $facturemai221->setNumeroChequeOuPaypal(45421548787);
        $manager->persist($facturemai221);
        $ligneFacturemai221 = new LigneFacture();
        $ligneFacturemai221->setService($service8);
        $ligneFacturemai221->setMontant(899);
        $ligneFacturemai221->setQuantite(3);
        $ligneFacturemai221->setFacture($facturemai221);
        $manager->persist($ligneFacturemai221);
        $facturemai221->addLigneFacture($ligneFacturemai221);
        $manager->persist($facturemai221);

        $facturemai321 = new Facture();
        $facturemai321->setConsultant($consultant3);
        $facturemai321->setNumeroFacture("2021-05-0063");
        $facturemai321->setDate(new \DateTime("21-05-2021"));
        $facturemai321->setTypeDePaiement($type3);
        $facturemai321->setNumeroChequeOuPaypal(45421548787);
        $manager->persist($facturemai321);
        $ligneFacturemai321 = new LigneFacture();
        $ligneFacturemai321->setService($service9);
        $ligneFacturemai321->setMontant(540);
        $ligneFacturemai321->setQuantite(2);
        $ligneFacturemai321->setFacture($facturemai321);
        $manager->persist($ligneFacturemai321);
        $facturemai321->addLigneFacture($ligneFacturemai321);
        $manager->persist($facturemai321);



        $facturejuin121 = new Facture();
        $facturejuin121->setConsultant($consultant1);
        $facturejuin121->setNumeroFacture("2021-06-0013");
        $facturejuin121->setDate(new \DateTime("07-06-2021"));
        $facturejuin121->setTypeDePaiement($type1);
        $facturejuin121->setNumeroChequeOuPaypal(45421548787);
        $manager->persist($facturejuin121);
        $ligneFacturejuin121 = new LigneFacture();
        $ligneFacturejuin121->setService($service7);
        $ligneFacturejuin121->setMontant(376);
        $ligneFacturejuin121->setQuantite(2);
        $ligneFacturejuin121->setFacture($facturejuin121);
        $manager->persist($ligneFacturejuin121);
        $facturejuin121->addLigneFacture($ligneFacturejuin121);
        $manager->persist($facturejuin121);

        $facturejuin221 = new Facture();
        $facturejuin221->setConsultant($consultant2);
        $facturejuin221->setNumeroFacture("2021-06-0023");
        $facturejuin221->setDate(new \DateTime("14-06-2021"));
        $facturejuin221->setTypeDePaiement($type2);
        $facturejuin221->setNumeroChequeOuPaypal(45421548787);
        $manager->persist($facturejuin221);
        $ligneFacturejuin221 = new LigneFacture();
        $ligneFacturejuin221->setService($service8);
        $ligneFacturejuin221->setMontant(899);
        $ligneFacturejuin221->setQuantite(3);
        $ligneFacturejuin221->setFacture($facturejuin221);
        $manager->persist($ligneFacturejuin221);
        $facturejuin221->addLigneFacture($ligneFacturejuin221);
        $manager->persist($facturejuin221);

        $facturejuin321 = new Facture();
        $facturejuin321->setConsultant($consultant3);
        $facturejuin321->setNumeroFacture("2021-06-0063");
        $facturejuin321->setDate(new \DateTime("21-06-2021"));
        $facturejuin321->setTypeDePaiement($type3);
        $facturejuin321->setNumeroChequeOuPaypal(45421548787);
        $manager->persist($facturejuin321);
        $ligneFacturejuin321 = new LigneFacture();
        $ligneFacturejuin321->setService($service9);
        $ligneFacturejuin321->setMontant(540);
        $ligneFacturejuin321->setQuantite(2);
        $ligneFacturejuin321->setFacture($facturejuin321);
        $manager->persist($ligneFacturejuin321);
        $facturejuin321->addLigneFacture($ligneFacturejuin321);
        $manager->persist($facturejuin321);



        $facturejuillet121 = new Facture();
        $facturejuillet121->setConsultant($consultant1);
        $facturejuillet121->setNumeroFacture("2021-07-0013");
        $facturejuillet121->setDate(new \DateTime("07-07-2021"));
        $facturejuillet121->setTypeDePaiement($type1);
        $facturejuillet121->setNumeroChequeOuPaypal(45421548787);
        $manager->persist($facturejuillet121);
        $ligneFacturejuillet121 = new LigneFacture();
        $ligneFacturejuillet121->setService($service7);
        $ligneFacturejuillet121->setMontant(376);
        $ligneFacturejuillet121->setQuantite(2);
        $ligneFacturejuillet121->setFacture($facturejuillet121);
        $manager->persist($ligneFacturejuillet121);
        $facturejuillet121->addLigneFacture($ligneFacturejuillet121);
        $manager->persist($facturejuillet121);

        $facturejuillet221 = new Facture();
        $facturejuillet221->setConsultant($consultant2);
        $facturejuillet221->setNumeroFacture("2021-07-0023");
        $facturejuillet221->setDate(new \DateTime("14-07-2021"));
        $facturejuillet221->setTypeDePaiement($type2);
        $facturejuillet221->setNumeroChequeOuPaypal(45421548787);
        $manager->persist($facturejuillet221);
        $ligneFacturejuillet221 = new LigneFacture();
        $ligneFacturejuillet221->setService($service8);
        $ligneFacturejuillet221->setMontant(899);
        $ligneFacturejuillet221->setQuantite(3);
        $ligneFacturejuillet221->setFacture($facturejuillet221);
        $manager->persist($ligneFacturejuillet221);
        $facturejuillet221->addLigneFacture($ligneFacturejuillet221);
        $manager->persist($facturejuillet221);

        $facturejuillet321 = new Facture();
        $facturejuillet321->setConsultant($consultant3);
        $facturejuillet321->setNumeroFacture("2021-07-0063");
        $facturejuillet321->setDate(new \DateTime("21-07-2021"));
        $facturejuillet321->setTypeDePaiement($type3);
        $facturejuillet321->setNumeroChequeOuPaypal(45421548787);
        $manager->persist($facturejuillet321);
        $ligneFacturejuillet321 = new LigneFacture();
        $ligneFacturejuillet321->setService($service9);
        $ligneFacturejuillet321->setMontant(540);
        $ligneFacturejuillet321->setQuantite(2);
        $ligneFacturejuillet321->setFacture($facturejuillet321);
        $manager->persist($ligneFacturejuillet321);
        $facturejuillet321->addLigneFacture($ligneFacturejuillet321);
        $manager->persist($facturejuillet321);




        $factureaout121 = new Facture();
        $factureaout121->setConsultant($consultant1);
        $factureaout121->setNumeroFacture("2021-08-0013");
        $factureaout121->setDate(new \DateTime("07-08-2021"));
        $factureaout121->setTypeDePaiement($type1);
        $factureaout121->setNumeroChequeOuPaypal(45421548787);
        $manager->persist($factureaout121);
        $ligneFactureaout121 = new LigneFacture();
        $ligneFactureaout121->setService($service7);
        $ligneFactureaout121->setMontant(376);
        $ligneFactureaout121->setQuantite(2);
        $ligneFactureaout121->setFacture($factureaout121);
        $manager->persist($ligneFactureaout121);
        $factureaout121->addLigneFacture($ligneFactureaout121);
        $manager->persist($factureaout121);

        $factureaout221 = new Facture();
        $factureaout221->setConsultant($consultant2);
        $factureaout221->setNumeroFacture("2021-08-0023");
        $factureaout221->setDate(new \DateTime("14-08-2021"));
        $factureaout221->setTypeDePaiement($type2);
        $factureaout221->setNumeroChequeOuPaypal(45421548787);
        $manager->persist($factureaout221);
        $ligneFactureaout221 = new LigneFacture();
        $ligneFactureaout221->setService($service8);
        $ligneFactureaout221->setMontant(899);
        $ligneFactureaout221->setQuantite(3);
        $ligneFactureaout221->setFacture($factureaout221);
        $manager->persist($ligneFactureaout221);
        $factureaout221->addLigneFacture($ligneFactureaout221);
        $manager->persist($factureaout221);

        $facturesaout321 = new Facture();
        $facturesaout321->setConsultant($consultant3);
        $facturesaout321->setNumeroFacture("2021-08-0063");
        $facturesaout321->setDate(new \DateTime("21-08-2021"));
        $facturesaout321->setTypeDePaiement($type3);
        $facturesaout321->setNumeroChequeOuPaypal(45421548787);
        $manager->persist($facturesaout321);
        $ligneFactureaout321 = new LigneFacture();
        $ligneFactureaout321->setService($service9);
        $ligneFactureaout321->setMontant(540);
        $ligneFactureaout321->setQuantite(2);
        $ligneFactureaout321->setFacture($facturesaout321);
        $manager->persist($ligneFactureaout321);
        $facturesaout321->addLigneFacture($ligneFactureaout321);
        $manager->persist($facturesaout321);






        $facturesseptembre121 = new Facture();
        $facturesseptembre121->setConsultant($consultant1);
        $facturesseptembre121->setNumeroFacture("2021-09-0013");
        $facturesseptembre121->setDate(new \DateTime("07-09-2021"));
        $facturesseptembre121->setTypeDePaiement($type1);
        $facturesseptembre121->setNumeroChequeOuPaypal(45421548787);
        $manager->persist($facturesseptembre121);
        $ligneFacturesseptembre121 = new LigneFacture();
        $ligneFacturesseptembre121->setService($service7);
        $ligneFacturesseptembre121->setMontant(376);
        $ligneFacturesseptembre121->setQuantite(2);
        $ligneFacturesseptembre121->setFacture($facturesseptembre121);
        $manager->persist($ligneFacturesseptembre121);
        $facturesseptembre121->addLigneFacture($ligneFacturesseptembre121);
        $manager->persist($facturesseptembre121);

        $facturesseptembre221 = new Facture();
        $facturesseptembre221->setConsultant($consultant2);
        $facturesseptembre221->setNumeroFacture("2021-09-0023");
        $facturesseptembre221->setDate(new \DateTime("14-09-2021"));
        $facturesseptembre221->setTypeDePaiement($type2);
        $facturesseptembre221->setNumeroChequeOuPaypal(45421548787);
        $manager->persist($facturesseptembre221);
        $ligneFacturesseptembre221 = new LigneFacture();
        $ligneFacturesseptembre221->setService($service8);
        $ligneFacturesseptembre221->setMontant(899);
        $ligneFacturesseptembre221->setQuantite(3);
        $ligneFacturesseptembre221->setFacture($facturesseptembre221);
        $manager->persist($ligneFacturesseptembre221);
        $facturesseptembre221->addLigneFacture($ligneFacturesseptembre221);
        $manager->persist($facturesseptembre221);

        $facturesseptembre321 = new Facture();
        $facturesseptembre321->setConsultant($consultant3);
        $facturesseptembre321->setNumeroFacture("2021-09-0063");
        $facturesseptembre321->setDate(new \DateTime("21-09-2021"));
        $facturesseptembre321->setTypeDePaiement($type3);
        $facturesseptembre321->setNumeroChequeOuPaypal(45421548787);
        $manager->persist($facturesseptembre321);
        $ligneFacturesseptembre321 = new LigneFacture();
        $ligneFacturesseptembre321->setService($service9);
        $ligneFacturesseptembre321->setMontant(540);
        $ligneFacturesseptembre321->setQuantite(2);
        $ligneFacturesseptembre321->setFacture($facturesseptembre321);
        $manager->persist($ligneFacturesseptembre321);
        $facturesseptembre321->addLigneFacture($ligneFacturesseptembre321);
        $manager->persist($facturesseptembre321);







        $facturesoctobre121 = new Facture();
        $facturesoctobre121->setConsultant($consultant1);
        $facturesoctobre121->setNumeroFacture("2021-10-0013");
        $facturesoctobre121->setDate(new \DateTime("07-10-2021"));
        $facturesoctobre121->setTypeDePaiement($type1);
        $facturesoctobre121->setNumeroChequeOuPaypal(45421548787);
        $manager->persist($facturesoctobre120);
        $ligneFactureoctobre121 = new LigneFacture();
        $ligneFactureoctobre121->setService($service7);
        $ligneFactureoctobre121->setMontant(376);
        $ligneFactureoctobre121->setQuantite(2);
        $ligneFactureoctobre121->setFacture($facturesoctobre121);
        $manager->persist($ligneFactureoctobre121);
        $facturesoctobre121->addLigneFacture($ligneFactureoctobre121);
        $manager->persist($facturesoctobre121);

        $facturesoctobre221 = new Facture();
        $facturesoctobre221->setConsultant($consultant2);
        $facturesoctobre221->setNumeroFacture("2021-10-0023");
        $facturesoctobre221->setDate(new \DateTime("14-10-2021"));
        $facturesoctobre221->setTypeDePaiement($type2);
        $facturesoctobre221->setNumeroChequeOuPaypal(45421548787);
        $manager->persist($facturesoctobre221);
        $ligneFacturesoctobre221 = new LigneFacture();
        $ligneFacturesoctobre221->setService($service8);
        $ligneFacturesoctobre221->setMontant(899);
        $ligneFacturesoctobre221->setQuantite(3);
        $ligneFacturesoctobre221->setFacture($facturesoctobre221);
        $manager->persist($ligneFacturesoctobre221);
        $facturesoctobre221->addLigneFacture($ligneFacturesoctobre221);
        $manager->persist($facturesoctobre221);

        $facturesoctobre321 = new Facture();
        $facturesoctobre321->setConsultant($consultant3);
        $facturesoctobre321->setNumeroFacture("2021-10-0063");
        $facturesoctobre321->setDate(new \DateTime("21-10-2021"));
        $facturesoctobre321->setTypeDePaiement($type3);
        $facturesoctobre321->setNumeroChequeOuPaypal(45421548787);
        $manager->persist($facturesoctobre321);
        $ligneFacturesoctobre321 = new LigneFacture();
        $ligneFacturesoctobre321->setService($service9);
        $ligneFacturesoctobre321->setMontant(540);
        $ligneFacturesoctobre321->setQuantite(2);
        $ligneFacturesoctobre321->setFacture($facturesoctobre321);
        $manager->persist($ligneFacturesoctobre321);
        $facturesoctobre321->addLigneFacture($ligneFacturesoctobre321);
        $manager->persist($facturesoctobre321);





        $facturesnovembre121 = new Facture();
        $facturesnovembre121->setConsultant($consultant1);
        $facturesnovembre121->setNumeroFacture("2021-11-0013");
        $facturesnovembre121->setDate(new \DateTime("07-11-2021"));
        $facturesnovembre121->setTypeDePaiement($type1);
        $facturesnovembre121->setNumeroChequeOuPaypal(45421548787);
        $manager->persist($facturesnovembre121);
        $ligneFacturesnovembre121 = new LigneFacture();
        $ligneFacturesnovembre121->setService($service7);
        $ligneFacturesnovembre121->setMontant(376);
        $ligneFacturesnovembre121->setQuantite(2);
        $ligneFacturesnovembre121->setFacture($facturesnovembre121);
        $manager->persist($ligneFacturesnovembre121);
        $facturesnovembre120->addLigneFacture($ligneFacturesnovembre121);
        $manager->persist($facturesnovembre120);

        $facturesnovembre221 = new Facture();
        $facturesnovembre221->setConsultant($consultant2);
        $facturesnovembre221->setNumeroFacture("2021-11-0023");
        $facturesnovembre221->setDate(new \DateTime("14-11-2021"));
        $facturesnovembre221->setTypeDePaiement($type2);
        $facturesnovembre221->setNumeroChequeOuPaypal(45421548787);
        $manager->persist($facturesnovembre221);
        $ligneFacturesnovembre221 = new LigneFacture();
        $ligneFacturesnovembre221->setService($service8);
        $ligneFacturesnovembre221->setMontant(899);
        $ligneFacturesnovembre221->setQuantite(3);
        $ligneFacturesnovembre221->setFacture($facturesnovembre221);
        $manager->persist($ligneFacturesnovembre221);
        $facturesnovembre221->addLigneFacture($ligneFacturesnovembre221);
        $manager->persist($facturesnovembre221);

        $facturesnovembre321 = new Facture();
        $facturesnovembre321->setConsultant($consultant3);
        $facturesnovembre321->setNumeroFacture("2021-11-0063");
        $facturesnovembre321->setDate(new \DateTime("21-11-2021"));
        $facturesnovembre321->setTypeDePaiement($type3);
        $facturesnovembre321->setNumeroChequeOuPaypal(45421548787);
        $manager->persist($facturesnovembre321);
        $ligneFacturesnovembre321 = new LigneFacture();
        $ligneFacturesnovembre321->setService($service9);
        $ligneFacturesnovembre321->setMontant(540);
        $ligneFacturesnovembre321->setQuantite(2);
        $ligneFacturesnovembre321->setFacture($facturesnovembre321);
        $manager->persist($ligneFacturesnovembre321);
        $facturesnovembre321->addLigneFacture($ligneFacturesnovembre321);
        $manager->persist($facturesnovembre321);





        $facturesdecembre121 = new Facture();
        $facturesdecembre121->setConsultant($consultant1);
        $facturesdecembre121->setNumeroFacture("2021-12-0013");
        $facturesdecembre121->setDate(new \DateTime("07-12-2021"));
        $facturesdecembre121->setTypeDePaiement($type1);
        $facturesdecembre121->setNumeroChequeOuPaypal(45421548787);
        $manager->persist($facturesdecembre121);
        $ligneFacturedecembre121 = new LigneFacture();
        $ligneFacturedecembre121->setService($service7);
        $ligneFacturedecembre121->setMontant(376);
        $ligneFacturedecembre121->setQuantite(2);
        $ligneFacturedecembre121->setFacture($facturesdecembre121);
        $manager->persist($ligneFacturedecembre121);
        $facturesdecembre121->addLigneFacture($ligneFacturedecembre121);
        $manager->persist($facturesdecembre121);

        $facturesdecembre221 = new Facture();
        $facturesdecembre221->setConsultant($consultant2);
        $facturesdecembre221->setNumeroFacture("2021-12-0023");
        $facturesdecembre221->setDate(new \DateTime("14-12-2021"));
        $facturesdecembre221->setTypeDePaiement($type2);
        $facturesdecembre221->setNumeroChequeOuPaypal(45421548787);
        $manager->persist($facturesdecembre221);
        $ligneFacturesdecembre221 = new LigneFacture();
        $ligneFacturesdecembre221->setService($service8);
        $ligneFacturesdecembre221->setMontant(899);
        $ligneFacturesdecembre221->setQuantite(3);
        $ligneFacturesdecembre221->setFacture($facturesdecembre221);
        $manager->persist($ligneFacturesdecembre221);
        $facturesdecembre221->addLigneFacture($ligneFacturesdecembre221);
        $manager->persist($facturesdecembre221);

        $facturesdecembre321 = new Facture();
        $facturesdecembre321->setConsultant($consultant3);
        $facturesdecembre321->setNumeroFacture("2021-12-0063");
        $facturesdecembre321->setDate(new \DateTime("21-12-2021"));
        $facturesdecembre321->setTypeDePaiement($type3);
        $facturesdecembre321->setNumeroChequeOuPaypal(45421548787);
        $manager->persist($facturesdecembre321);
        $ligneFacturesdecembre321 = new LigneFacture();
        $ligneFacturesdecembre321->setService($service9);
        $ligneFacturesdecembre321->setMontant(540);
        $ligneFacturesdecembre321->setQuantite(2);
        $ligneFacturesdecembre321->setFacture($facturesdecembre321);
        $manager->persist($ligneFacturesdecembre321);
        $facturesdecembre321->addLigneFacture($ligneFacturesdecembre321);
        $manager->persist($facturesdecembre321);




            /*
            * Création d'une Facture qui contient plusieurs lignes de facture
            */
        $factureTestMultiple = new Facture();
        $factureTestMultiple->setConsultant($consultant4);
        $factureTestMultiple->setNumeroFacture("2021-03-0063");
        $factureTestMultiple->setDate(new \DateTime("21-03-2021"));
        $factureTestMultiple->setTypeDePaiement($type3);
        $factureTestMultiple->setNumeroChequeOuPaypal(45421548787);
        $manager->persist($factureTestMultiple);
        $ligneFactureTestMultiple1 = new LigneFacture();
        $ligneFactureTestMultiple1->setQuantite(1);
        $ligneFactureTestMultiple1->setMontant(300);
        $ligneFactureTestMultiple1->setService($service2);
        $ligneFactureTestMultiple1->setFacture($factureTestMultiple);
        $manager->persist($ligneFactureTestMultiple1);
        $ligneFactureTestMultiple2 = new LigneFacture();
        $ligneFactureTestMultiple2->setQuantite(2);
        $ligneFactureTestMultiple2->setMontant(80);
        $ligneFactureTestMultiple2->setService($service1);
        $ligneFactureTestMultiple2->setFacture($factureTestMultiple);
        $manager->persist($ligneFactureTestMultiple2);
        $ligneFactureTestMultiple3 = new LigneFacture();
        $ligneFactureTestMultiple3->setService($service3);
        $ligneFactureTestMultiple3->setQuantite(3);
        $ligneFactureTestMultiple3->setMontant(100);
        $ligneFactureTestMultiple3->setFacture($factureTestMultiple);
        $manager->persist($ligneFactureTestMultiple3);
        $factureTestMultiple->addLigneFacture($ligneFactureTestMultiple1);
        $factureTestMultiple->addLigneFacture($ligneFactureTestMultiple2);
        $factureTestMultiple->addLigneFacture($ligneFactureTestMultiple3);
        $manager->persist($factureTestMultiple);
        $manager->flush();
    }
}
