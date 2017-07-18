
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

## Ontology
select s > 0.7 & c > 0.7
```
(Interface: Browsable?)
	 <- (Access: Public & Type: Specification & Scope: Formats=owl & Collection: Size=N/A & Target audience=researchers & Interface: Data Dump? & Access: Free/Charged=Free & Purpose: Research & Data size=N/A & Format: Interoperable? & Resource type=Ontology)
	 (s: 0.769, c: 0.909)
(Collection: Size=N/A & Interface: Data Dump? & Data size=N/A)
	 <- (Access: Public & Type: Specification & Scope: Formats=owl & Target audience=researchers & Access: Free/Charged=Free & Purpose: Research & Format: Interoperable? & Resource type=Ontology)
	 (s: 0.846, c: 0.917)
```

## Schema
 > select s > 0.3 & c > 0.3
 ```
(Scope: Formats=pdf & Situation/Task=musicology)
	 <- (Access: Public & Access: license=Open Access & Scope: Object type=Score & Feature: Structure & Target audience=researchers & Scope: Formats=xml & Access: Free/Charged=Free & Feature: Lyrics & Purpose: Research & Scope: Formats=rng & Feature: Harmony & Type: Specification & Resource type=Schema & Feature: Rhythm & Feature: Melody & Situation/Task=music annotation & Format: Interoperable? & Feature: Descriptive Metadata & Scope: MO type=Score & Symbolic: Machine readable?)
	 (s: 0.333, c: 1)
(Scope: Formats=xml & Scope: Formats=rng & Situation/Task=music annotation & Format: Interoperable? & Symbolic: Machine readable?)
	 <- (Access: Public & Access: license=Open Access & Scope: Object type=Score & Feature: Structure & Target audience=researchers & Access: Free/Charged=Free & Feature: Lyrics & Purpose: Research & Scope: Formats=pdf & Feature: Harmony & Type: Specification & Resource type=Schema & Feature: Rhythm & Feature: Melody & Feature: Descriptive Metadata & Scope: MO type=Score & Situation/Task=musicology)
	 (s: 0.333, c: 1)
(Scope: Formats=xml & Scope: Formats=rng & Situation/Task=music annotation & Format: Interoperable? & Symbolic: Machine readable?)
	 <- (Access: Public & Access: license=Open Access & Scope: Object type=Score & Feature: Structure & Target audience=researchers & Access: Free/Charged=Free & Feature: Lyrics & Purpose: Research & Feature: Harmony & Type: Specification & Resource type=Schema & Feature: Rhythm & Feature: Melody & Feature: Descriptive Metadata & Scope: MO type=Score)
	 (s: 0.333, c: 0.5)
(Scope: Formats=pdf & Situation/Task=musicology)
	 <- (Access: Public & Access: license=Open Access & Scope: Object type=Score & Feature: Structure & Target audience=researchers & Access: Free/Charged=Free & Feature: Lyrics & Purpose: Research & Feature: Harmony & Type: Specification & Resource type=Schema & Feature: Rhythm & Feature: Melody & Feature: Descriptive Metadata & Scope: MO type=Score)
	 (s: 0.333, c: 0.5)
```

## Format
> select s > 0.3 & c > 0.3
```
(Purpose: Learning)
	 <- (Access: Public & Resource type=Format & Type: Specification & Access: Free/Charged=Free & Format: Interoperable?)
	 (s: 0.5, c: 0.667)
(Access: license=Open Access & Situation/Task=music annotation)
	 <- (Access: Public & Resource type=Format & Type: Specification & Access: Free/Charged=Free & Format: Interoperable?)
	 (s: 0.5, c: 0.667)
(Target audience=researchers)
	 <- (Access: Public & Resource type=Format & Type: Specification & Access: Free/Charged=Free & Format: Interoperable?)
	 (s: 0.5, c: 0.667)
```	