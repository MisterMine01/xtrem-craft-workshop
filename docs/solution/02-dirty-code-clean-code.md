# Clean code VS Dirty code

## Qu'est-ce que du code sale ?

- Code dans une seule fonction
- Tout dans le même fichier
- Difficilement explicable
- Variable mal nommé (ex : int a -> qui n'est pas explicite)
- Ne pas écrire en fr et en ang
---
**Correction**:
- Mauvais nommage 
  - pas explicite : var i 
  - pas descriptif : isTruc -> bool
- Mauvais découpage de fonction:
  - trop de lignes
  - plusieurs responsabilités
  - complexité cyclomatique
- Duplication
- Pas de doc/ pas de commentaires 
  - doc obsolète
  - trop de doc
  - mix de langues
  - acronymes

### Code sale = Code non testé

## Qu'est-ce que du code propre ?

- Code et doc facilement compréhensible
- Code documenté 
- Code decoupé
- Fonction optimisé avec le moins de ligne possible
- Code qui respecte son modèle 
- Code éco responsable
- Classe qui fait que ce qu'elle est censée faire
---
**Correction**
- Tests:
  - != niveau ou type
  - coverage 
  - TDD
- SOLID
- Architecturé 
- Convention de nommage
  -  snake/ camet case
  - ubiquitous language 