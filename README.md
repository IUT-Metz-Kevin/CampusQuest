# School_Framework_CampusQuest — démo versionnée du cours Framework

Projet Laravel de **démonstration (Campus Quest)** utilisé en livecoding pendant
le cours Framework. Chaque **tag** marque la fin d'un chapitre : le **diff entre
deux tags consécutifs = le code écrit pendant ce chapitre**.

Les tags servent de **paliers de rattrapage** : un étudiant en retard relit le
diff du tag du chapitre et refait sa partie sur son projet WishFlix.

## Lire le code d'un chapitre

```bash
git diff s3-ch1-table-objet s3-ch2-relation-1n   # code du chapitre 2 de la S3
git show s3-ch2-relation-1n                      # diff + message du commit taggé
```

## Revenir sur un tag

```bash
git checkout s3-ch2-relation-1n   # état du code en fin de chapitre (HEAD détachée)
git checkout main                 # revenir à l'état final
```

## Tableau tag ↔ séance ↔ chapitre

| Tag | Séance | Chapitre |
|-----|--------|----------|
| `base` | — | Projet Laravel 12 de départ (inclut l'état produit par la S1 : installation + lecture d'une requête ; les tags `s1-ch3-installation` / `s1-ch4-requete` déclarés dans le LIVECODING ne sont pas créés : la S1 ne produit aucun diff de code) |
| `s2-ch1-routing` | S2 | Routing (closure, paramètre, contrainte, nom) |
| `s2-ch2-blade-vue` | S2 | Blade : la vue (`{{ }}`, `@forelse`) |
| `s2-ch3-controleurs` | S2 | Contrôleurs (`Request`, réponses) |
| `s2-ch4-layouts` | S2 | Blade : les layouts |
| `s2-ch5-vite` | S2 | Vite et CSS par page |
| `s2-ch6-erreurs` | S2 | Pages d'erreur (404) |
| `s3-ch1-table-objet` | S3 | Une table, un objet (modèle, migration, Tinker) |
| `s3-ch2-relation-1n` | S3 | Relation un-à-plusieurs (FK, `$fillable`) |
| `s3-ch3-relation-nn` | S3 | Relation plusieurs-à-plusieurs (pivot) |
| `s3-ch4-seeders-factory` | S3 | Seeders et factory |
| `s3-ch5-catalogue-n1` | S3 | Catalogue branché + N+1 constaté |
| `s5-ch1-formulaire` | S5 | Formulaire de création |
| `s5-ch2-csrf` | S5 | `@csrf` |
| `s5-ch3-validation` | S5 | Validation côté serveur |
| `s5-ch4-edition` | S5 | Édition et suppression à la main |
| `s5-ch5-resource` | S5 | `Route::resource` + route model binding |
| `s5-ch6-form-request` | S5 | Form Requests |
| `s5-ch7-services` | S5 | `QuestService` + injection |

> **S4 absente** : la séance 4 (requêtes, eager loading) n'existe pas encore dans
> ce dépôt — l'état de départ de la S5 est la fin de la S3. Quand la S4 sera
> écrite, ses commits et tags `s4-chY-*` s'inséreront entre `s3-ch5-catalogue-n1`
> et `s5-ch1-formulaire` (réécriture d'historique nécessaire, tags déplacés).

Pas de `vendor/`, `node_modules/` ni `.env` (voir `.gitignore`). Installation et
commandes Sail : voir la section « Installation » ci-dessous.

---

# Campus Quest — projet de démonstration (S2 + S3)

Projet Laravel 12 + Sail utilisé par le formateur pour les **live coding** des séances 2 (Routing, contrôleurs et Blade) et 3 (Eloquent : modèles, relations, migrations) du cours Framework.

## Contexte

**Campus Quest** : une app de défis de campus. En S2, chaque **quête** vit dans un **tableau PHP** du contrôleur ; en S3, les quêtes passent en base (`quests`, `categories`, `locations`, pivot `location_quest`). Ce n'est pas l'atelier étudiant (WishFlix).

## Installation (première fois)

```bash
cp .env.example .env
docker run --rm -u "$(id -u):$(id -g)" -v "$(pwd):/var/www/html" -w /var/www/html \
    laravelsail/php84-composer:latest composer install --ignore-platform-reqs
./vendor/bin/sail up -d
./vendor/bin/sail artisan key:generate
./vendor/bin/sail npm install
./vendor/bin/sail npm run dev   # garder ouvert dans un second terminal
```

Puis ouvrir <http://localhost>.

> Le projet démo tourne en **SQLite** (`DB_CONNECTION=sqlite`) — `database/database.sqlite` sera créé au premier `migrate`. Les slides montrent la variante MariaDB/Sail ; les commandes `sail artisan` sont identiques.

## Commandes utiles

```bash
./vendor/bin/sail up -d            # démarrer
./vendor/bin/sail down             # arrêter
./vendor/bin/sail artisan route:list
./vendor/bin/sail artisan migrate:fresh --seed
./vendor/bin/sail npm run build    # assets sans serveur Vite
```

## État du projet

Installation standard, **sans le code des étapes** (état de départ de la S2 : routes par défaut, vues `welcome`, pas de quêtes en base). Les fichiers finaux sont dans les dossiers `solution/` de chaque séance :

- [`../seance-02/`](../seance-02) — `LIVECODING.md` + `solution/` : `cp -r ../seance-02/solution/* .`
- [`../seance-03/`](../seance-03) — `LIVECODING.md` + `solution/` : `cp -r ../seance-03/solution/* .` (prérequis : solution S2 appliquée)

## Déroulé

Voir [seance-02/LIVECODING.md](../seance-02/LIVECODING.md) et [seance-03/LIVECODING.md](../seance-03/LIVECODING.md).
