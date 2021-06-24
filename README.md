# GestionComptaCLi
#Utiliser une invite de commande comme par exemple : Cmder
#Se mettre dans le repertoire de travail de Wamp ou Xampp
cd wamp64/www ou cd xampp/htdocs
#installation de Symfony
composer create-project symfony/website-skeleton EnergieDenisSanchezSaisieComptaGestionCli
composer require symfony/apache-pack
#Se mettre dans le dossier
#Pour se déplacer dans le dossier
cd EnergieDenisSanchezSaisieComptaGestionCli
#--------------------------------------------------------------------
Command line instructions
You can also upload existing files from your computer using the instructions below.
Git global setup
git config --global user.name "Denis Sanchez"
git config --global user.email "dsanchez@campus-eni.fr"
Create a new repository
git clone https://gitlab.com/energiedenissanchez/SaisieComptaGestionCli.git
cd SaisieComptaGestionCli
touch README.md
git add README.md
git commit -m "add README"
git push -u origin master
Push an existing folder
cd existing_folder
git init
git remote add origin https://gitlab.com/energiedenissanchez/SaisieComptaGestionCli.git
git add .
git commit -m "Initial commit"
git push -u origin master
Push an existing Git repository
cd existing_repo
git remote rename origin old-origin
git remote add origin https://gitlab.com/energiedenissanchez/SaisieComptaGestionCli.git
git push -u origin --all
git push -u origin --tags
#------------------------------------------------------------------
#clone dans le dossier EnergieDenisSanchezSaisieComptaGestionCli
git clone https://gitlab.com/energiedenissanchez/saisiecomptagestioncli.git
#Une fois dans le répertoire on peut vérifier ce qu'il contient
ls -ail
#Quand on veut remonter d'un niveau
cd ..
#Tester dans un navigateur:
http://localhost/EnergieDenisSanchezSaisieComptaGestionCli/public/
#Info Importante:
il faut rajouter dans le fichier entrypoints.json le nom de l'application locale et le dossier public et le tout séparer par des "/"

{
"entrypoints": {
"app": {
"js": [
"/SaisieComptaGestionCliV2/public/build/runtime.js",
"/SaisieComptaGestionCliV2/public/build/vendors-node_modules_symfony_stimulus-bridge_dist_index_js-node_modules_symfony_ux-chartjs_di-6d1b54.js",
"/SaisieComptaGestionCliV2/public/build/app.js"
],
"css": [
"/SaisieComptaGestionCliV2/public/build/app.css"
]
}
}
}
