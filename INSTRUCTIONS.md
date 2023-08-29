# Objectif

Concevoir et écrire un programme Symfony implémentant la spécification ci-dessous. Le code écrit permettra d’identifier
différents critères de qualité :

- Conception objet
- Qualité de nommage
- Qualité et concision de la documentation
- Tests

# Description

Un héros s'aventurait dans un monde dangereux, frayant son passage dans les bois obscurs.  
Il s'agit de modéliser les déplacements d'un personnage sur une carte.

## Carte

La carte est modélisée à l'aide de caractères dans un fichier texte au format UTF-8 (voir le fichier
dans `public/data/carte.txt`).

### Exemple :

```
###    ######    ###
###      ##      ###
##     ##  ##     ##
#      ##  ##      #
##                ##
#####          #####
###### ##  ##  #####
#     ######     # 
     ########       
    ############    
    ############    
     ########      #
#     ######     ##
###### ##  ## ######
#####          #####
##                ##
#   ## #    # ##   #
##   ##      ##   ##
###    #    #    ###
###    ######    ###
```

## Légende

- `#` : bois impénétrables
- `[ ]` (caractère espace) : case où le personnage peut se déplacer

## Déplacement du personnage

Les déplacements du personnage sont définis par un fichier avec les caractéristiques suivantes :

- Encodage: UTF-8
- Première ligne : Contient les coordonnées initiales du personnage sous la forme "x,y". Les coordonnées (0,0)
  correspondent au coin supérieur gauche de la carte.
- Deuxième ligne : Les déplacements du personnage définis sous la forme d'une succession de caractères représentant les
  directions cardinales (N, S, E, O). Chaque caractère correspond au déplacement d'une case.

## Interaction avec les éléments de la carte

- Le personnage ne peut pas aller au-delà des bords de la carte.
- Le personnage ne peut pas aller sur les cases occupées par les bois impénétrables.

# Tests

## Premier test

Le fichier suivant est fourni en entrée :
Départ (Y, X): 3,0  
Mouvements: SSSSEEEEEENN

Résultat attendu : Le personnage doit se trouver en (9,2).

## Deuxième test

Le fichier suivant est fourni en entrée :
Départ (Y, X): 12,4  
Mouvements: OONOOOSSOO

Résultat attendu : Le personnage doit se trouver en (7,5).
