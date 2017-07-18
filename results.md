Lattices generated for types:
- Repository (158, 29123)
- Digital Library (29, 1606)
- Digital edition (21, 609)
- Dataset (36, 1158)
- Catalogue (44, 788)
- Schema (2, 4)


# Bottom concepts:

# Repository


# RULES

Characterization from the key dimensions, considering heads of rules with highest support & confidence


## Repository
s >= 0.95 & c >= 0.95

```
(Interface: Human consumption?)
	 <- (Resource type=Repository & Type: Collection)
	 (s: 0.962, c: 0.975)
(Type: Collection)
	 <- (Resource type=Repository & Interface: Human consumption?)
	 (s: 0.962, c: 0.994)
(Interface: SPARQL endpoint?=N/A)
	 <- (Resource type=Repository & Type: Collection)
	 (s: 0.956, c: 0.968)
(Type: Collection)
	 <- (Resource type=Repository & Interface: SPARQL endpoint?=N/A)
	 (s: 0.956, c: 0.993)
(Interface: Human consumption?)
	 <- (Resource type=Repository)
	 (s: 0.969, c: 0.975)
(Interface: SPARQL endpoint?=N/A)
	 <- (Resource type=Repository)
	 (s: 0.962, c: 0.968)
(Type: Collection)
	 <- (Resource type=Repository)
	 (s: 0.987, c: 0.994)
(Type: Collection)
	 <- (Access: Public & Resource type=Repository)
	 (s: 0.962, c: 0.994)
(Access: Public)
	 <- (Resource type=Repository & Type: Collection)
	 (s: 0.962, c: 0.975)
(Type: Collection)
	 <- (Resource type=Repository & Interface: Browsable?)
	 (s: 0.956, c: 0.993)
(Interface: Browsable?)
	 <- (Resource type=Repository & Type: Collection)
	 (s: 0.956, c: 0.968)
(Access: Public)
	 <- (Resource type=Repository)
	 (s: 0.969, c: 0.975)
(Interface: Browsable?)
	 <- (Resource type=Repository)
	 (s: 0.962, c: 0.968)
```

A repository is a collection of publicly accessible resources organized for human consumption, browsable.

## Dataset

> select s > 0.8 & c > 0.8

```
(Format: Interoperable?)
	 <- (Resource type=Dataset & Type: Collection & Access: Free/Charged=Free & Purpose: Research)
	 (s: 0.811, c: 0.968)
(Purpose: Research & Format: Interoperable?)
	 <- (Resource type=Dataset & Type: Collection & Access: Free/Charged=Free)
	 (s: 0.811, c: 0.938)
(Type: Collection)
	 <- (Resource type=Dataset & Access: Free/Charged=Free & Purpose: Research & Format: Interoperable?)
	 (s: 0.811, c: 0.968)
(Type: Collection)
	 <- (Resource type=Dataset)
	 (s: 0.892, c: 0.917)
(Purpose: Research & Format: Interoperable?)
	 <- (Resource type=Dataset & Access: Free/Charged=Free)
	 (s: 0.838, c: 0.939)
(Format: Interoperable?)
	 <- (Resource type=Dataset & Access: Free/Charged=Free & Purpose: Research)
	 (s: 0.838, c: 0.969)
(Access: Free/Charged=Free & Purpose: Research & Format: Interoperable?)
	 <- (Resource type=Dataset)
	 (s: 0.838, c: 0.861)
(Purpose: Research)
	 <- (Resource type=Dataset & Type: Collection & Access: Free/Charged=Free)
	 (s: 0.838, c: 0.969)
(Type: Collection)
	 <- (Resource type=Dataset & Access: Free/Charged=Free & Purpose: Research)
	 (s: 0.838, c: 0.969)
(Type: Collection)
	 <- (Resource type=Dataset & Access: Free/Charged=Free)
	 (s: 0.865, c: 0.97)
(Access: Free/Charged=Free)
	 <- (Resource type=Dataset & Type: Collection)
	 (s: 0.865, c: 0.97)
(Access: Public)
	 <- (Resource type=Dataset & Access: Free/Charged=Free)
	 (s: 0.811, c: 0.909)
(Access: Free/Charged=Free)
	 <- (Resource type=Dataset)
	 (s: 0.892, c: 0.917)
(Purpose: Research)
	 <- (Resource type=Dataset & Access: Free/Charged=Free)
	 (s: 0.865, c: 0.97)
```
A Dataset is a collection published in an *interoperable format* for research purposes, which access is public and free of charge.

## Digital Library
select s > 0.85 & c > 0.85
```
(Access: Public)
	 <- (Target audience=researchers & Type: Collection & Interface: Browsable? & Resource type=Digital Library & Feature: Descriptive Metadata & Interface: Human consumption?)
	 (s: 0.867, c: 0.963)
(Target audience=researchers & Type: Collection & Purpose: Research & Interface: Browsable? & Feature: Descriptive Metadata & Interface: Human consumption?)
	 <- (Resource type=Digital Library)
	 (s: 0.867, c: 0.897)
(Purpose: Research)
	 <- (Target audience=researchers & Type: Collection & Interface: Browsable? & Resource type=Digital Library & Feature: Descriptive Metadata & Interface: Human consumption?)
	 (s: 0.867, c: 0.963)
(Target audience=researchers & Type: Collection & Interface: Browsable? & Feature: Descriptive Metadata & Interface: Human consumption?)
	 <- (Resource type=Digital Library)
	 (s: 0.9, c: 0.931)
```
A Digital Library is a browsable collection focused on *descriptive metadata*, delivered with public access for research purposes.

## Digital edition
select s > 0.9 & c > 0.9

```
(Type: Collection)
	 <- (Resource type=Digital edition & Access: Public & Target audience=researchers & Access: Free/Charged=Free & Purpose: Research & Feature: Descriptive Metadata & Interface: Human consumption?)
	 (s: 0.864, c: 0.905)
(Scope: Object type=Score & Scope: MO type=Score)
	 <- (Resource type=Digital edition & Access: Public & Target audience=researchers & Access: Free/Charged=Free & Purpose: Research & Feature: Descriptive Metadata & Interface: Human consumption?)
	 (s: 0.864, c: 0.905)
(Interface: Browsable?)
	 <- (Resource type=Digital edition & Access: Public & Target audience=researchers & Access: Free/Charged=Free & Purpose: Research & Feature: Descriptive Metadata & Interface: Human consumption?)
	 (s: 0.909, c: 0.952)
```
Digital editions are *browsable scores* for human consumption, publicy accessible, free of charge, for research purposes, including descriptive metadata.

## Catalogue
select s > 0.95 & c > 0.95
```
(Access: Public & Interface: Human consumption?)
	 <- (Type: Collection & Interface: Browsable? & Resource type=Catalogue & Feature: Descriptive Metadata & Interface: SPARQL endpoint?=N/A)
	 (s: 0.911, c: 0.976)
(Feature: Descriptive Metadata)
	 <- (Access: Public & Type: Collection & Interface: Browsable? & Resource type=Catalogue & Interface: SPARQL endpoint?=N/A & Interface: Human consumption?)
	 (s: 0.911, c: 0.953)
(Access: Public & Interface: Human consumption?)
	 <- (Type: Collection & Purpose: Research & Interface: Browsable? & Resource type=Catalogue & Interface: SPARQL endpoint?=N/A)
	 (s: 0.933, c: 0.977)
(Purpose: Research)
	 <- (Access: Public & Type: Collection & Interface: Browsable? & Resource type=Catalogue & Interface: SPARQL endpoint?=N/A & Interface: Human consumption?)
	 (s: 0.933, c: 0.977)
(Purpose: Research)
	 <- (Type: Collection & Interface: Browsable? & Resource type=Catalogue & Feature: Descriptive Metadata & Interface: SPARQL endpoint?=N/A)
	 (s: 0.911, c: 0.976)
(Feature: Descriptive Metadata)
	 <- (Type: Collection & Purpose: Research & Interface: Browsable? & Resource type=Catalogue & Interface: SPARQL endpoint?=N/A)
	 (s: 0.911, c: 0.953)
(Feature: Descriptive Metadata)
	 <- (Type: Collection & Interface: Browsable? & Resource type=Catalogue & Interface: SPARQL endpoint?=N/A)
	 (s: 0.933, c: 0.955)
(Access: Public & Interface: Human consumption?)
	 <- (Type: Collection & Interface: Browsable? & Resource type=Catalogue & Interface: SPARQL endpoint?=N/A)
	 (s: 0.956, c: 0.977)
(Purpose: Research)
	 <- (Type: Collection & Interface: Browsable? & Resource type=Catalogue & Interface: SPARQL endpoint?=N/A)
	 (s: 0.956, c: 0.977)
(Access: Free/Charged=Free)
	 <- (Type: Collection & Purpose: Research & Interface: Browsable? & Resource type=Catalogue & Interface: SPARQL endpoint?=N/A)
	 (s: 0.911, c: 0.953)
(Purpose: Research)
	 <- (Type: Collection & Access: Free/Charged=Free & Interface: Browsable? & Resource type=Catalogue & Interface: SPARQL endpoint?=N/A)
	 (s: 0.911, c: 0.976)
(Access: Free/Charged=Free)
	 <- (Access: Public & Type: Collection & Interface: Browsable? & Resource type=Catalogue & Interface: SPARQL endpoint?=N/A & Interface: Human consumption?)
	 (s: 0.911, c: 0.953)
(Access: Public & Interface: Human consumption?)
	 <- (Type: Collection & Access: Free/Charged=Free & Interface: Browsable? & Resource type=Catalogue & Interface: SPARQL endpoint?=N/A)
	 (s: 0.911, c: 0.976)
(Format: Interoperable?)
	 <- (Type: Collection & Interface: Browsable? & Resource type=Catalogue & Interface: SPARQL endpoint?=N/A)
	 (s: 0.911, c: 0.932)
(Access: Free/Charged=Free)
	 <- (Type: Collection & Interface: Browsable? & Resource type=Catalogue & Interface: SPARQL endpoint?=N/A)
	 (s: 0.933, c: 0.955)
```
A Catalogue is focused on browsable *descriptive metadata* exposed both for human consumption and in an *interoperable format*, publicy accessible, free of charge.
