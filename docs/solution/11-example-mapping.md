# Example Mapping

## Format de restitution
*(rappel, pour chaque US)*

```markdown
## Titre de l'US (post-it jaunes)

> Question (post-it rouge)

### Règle Métier (post-it bleu)

Exemple: (post-it vert)

- [ ] 5 USD + 10 EUR = 17 USD
```

Vous pouvez également joindre une photo du résultat obtenu en utilisant les post-its.

## Story 1: Define Pivot Currency
```gherkin
As a Foreign Exchange Expert
I want to be able to define a Pivot Currency
So that I can express exchange rates based on it
```

Exemple :
- Pas de devise 
- Créer une banque
* Erreur : devise pivot obligatoire

## Story 2: Add an exchange rate
```gherkin
As a Foreign Exchange Expert
I want to add/update exchange rates by specifying: a multiplier rate and a currency
So they can be used to evaluate client portfolios
```

Exemple :
Je change le taux de change alors la conversion change
- Banque : EUR
- Ajouter un taux de change : KRW -> 3 => 10 € = 30 KRW
- Update un taux de change : KRW -> 4000
* 10€ -> 40000 KRW

## Story 3: Convert a Money

```gherkin
As a Bank Consumer
I want to convert a given amount in currency into another currency
So it can be used to evaluate client portfolios
```

Exemple :
- Banque : EUR
- Taux de change : USD -> 1.2
- convert 10€ -> USD
* 12 USD 

Rule : RoundTripping 
- Banque : EUR
- Taux de change : USD -> 1.2
- convert 10€ -> USD -> EUR
* 9€ <= resultat <= 11€ 
* (10€ plus ou moins 10%)

Exemple :
- Banque : EUR
- EUR -> EUR 
- 10€ -> 10€ -> 10€ => pas de taux de change 

Exemple :
- Banque : EUR
- KRW -> USD 
- KRW -> EUR -> USD

Exemple : 
- Pas de devise pivot
* Erreur : devise pivot obligatoire
