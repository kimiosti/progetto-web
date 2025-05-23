-- *********************************************
-- * SQL MySQL generation                      
-- *--------------------------------------------
-- * DB-MAIN version: 11.0.2              
-- * Generator date: Sep 14 2021              
-- * Generation date: Tue Mar 18 17:23:34 2025 
-- * LUN file: C:\xampp\htdocs\progetto-web\database\PURE-ESSENCE.lun 
-- * Schema: DATABASE/2 
-- ********************************************* 


-- Database Section
-- ________________ 

create database PUREESSENCE;
use PUREESSENCE;


-- Tables Section
-- _____________ 

create table ACQUIRENTE (
     username varchar(50) not null,
     password char(128) not null,
     email varchar(100) not null,
     telefono varchar(10) not null,
     constraint IDACQUIRENTE primary key (username));

create table PRODOTTO (
     IDprodotto int not null,
     nome varchar(100) not null,
     didascalia varchar(300) not null,
     descrizione varchar(1500) not null,
     URLimmagine varchar(50) not null,
     marca varchar(80) not null,
     sottocategoria varchar(50) not null,
     constraint IDPRODOTTO primary key (IDprodotto));

create table VENDITORE (
     username varchar(50) not null,
     password char(128) not null,
     email varchar(100) not null,
     telefono varchar(10) not null,
     constraint IDVENDITORE primary key (username));

create table DISPONIBILITÀ (
     IDdisponibilità int not null,
     taglia varchar(5) not null,
     prezzo float(1) not null,
     quantità int not null,
     IDprodotto int not null,
     usernameVenditore varchar(50) not null,
     constraint IDDISPONIBILITÀ primary key (IDdisponibilità));

create table ORDINE (
     IDordine int not null,
     stato varchar(20) not null,
     usernameAcquirente varchar(50) not null,
     constraint IDORDINE primary key (IDordine));

create table INCLUSIONE (
     IDdisponibilità int not null,
     IDordine int not null,
     quantità int not null,
     constraint IDINCLUSIONE primary key (IDdisponibilità, IDordine));

create table PAGAMENTO (
     IDordine int not null,
     usernameAcquirente varchar(50) not null,
     data date not null,
     prezzo float(1) not null,
     constraint IDPAGAMENTO primary key (usernameAcquirente, IDordine),
     constraint FKFINALITÀ_ID unique (IDordine));

create table `NOTIFICA-ACQUIRENTE` (
     titolo varchar(20) not null,
     testo varchar(100) not null,
     constraint `IDNOTIFICA-ACQUIRENTE` primary key (titolo));

create table `NOTIFICA-VENDITORE` (
     titolo varchar(20) not null,
     testo varchar(100) not null,
     constraint `IDNOTIFICA-VENDITORE` primary key (titolo));

create table PREFERITO (
     usernameAcquirente varchar(50) not null,
     IDprodotto int not null,
     constraint IDPREFERITO primary key (usernameAcquirente, IDprodotto));

create table CATEGORIA (
     nome varchar(50) not null,
     descrizione tinytext not null,
     constraint IDCATEGORIA primary key (nome));

create table OFFERTA (
     IDofferta int not null,
     URLcopertina varchar(50) not null,
     didascalia varchar(100) not null,
     descrizione varchar(1500) not null,
     percentuale int not null,
     spedizioneGratis char not null,
     inizio date not null,
     fine date not null,
     usernameVenditore varchar(50) not null,
     categoria varchar(50),
     marca varchar(80),
     constraint IDOFFERTA primary key (IDofferta));

create table MARCA (
     nome varchar(80) not null,
     constraint IDMARCA primary key (nome));

create table SOTTOCATEGORIA (
     nome varchar(50) not null,
     categoria varchar(50) not null,
     constraint IDSOTTOCATEGORIA primary key (nome));

create table `RICEZIONE-ACQUIRENTE` (
     usernameAcquirente varchar(50) not null,
     titoloNotifica varchar(20) not null,
     data date not null,
     letto char not null,
     constraint `IDRICEZIONE-ACQUIRENTE` primary key (usernameAcquirente, titoloNotifica));

create table `RICEZIONE-VENDITORE` (
     usernameVenditore varchar(50) not null,
     titoloNotifica varchar(20) not null,
     data date not null,
     letto char not null,
     constraint `IDRICEZIONE-VENDITORE` primary key (usernameVenditore, titoloNotifica));


-- Constraints Section
-- ___________________ 

alter table PRODOTTO add constraint FKPRODUZIONE
     foreign key (marca)
     references MARCA (nome);

alter table PRODOTTO add constraint FKAPPARTENENZA
     foreign key (sottocategoria)
     references SOTTOCATEGORIA (nome);

alter table DISPONIBILITÀ add constraint FKDESTINAZIONE
     foreign key (IDprodotto)
     references PRODOTTO (IDprodotto);

alter table DISPONIBILITÀ add constraint FKPROPOSTA
     foreign key (usernameVenditore)
     references VENDITORE (username);

alter table ORDINE add constraint FKSVOLGIMENTO
     foreign key (usernameAcquirente)
     references ACQUIRENTE (username);

alter table INCLUSIONE add constraint FKPREVISIONE
     foreign key (IDordine)
     references ORDINE (IDordine);

alter table INCLUSIONE add constraint FKRELAZIONE
     foreign key (IDdisponibilità)
     references DISPONIBILITÀ (IDdisponibilità);

alter table PAGAMENTO add constraint FKEFFETTUAZIONE
     foreign key (usernameAcquirente)
     references ACQUIRENTE (username);

alter table PAGAMENTO add constraint FKFINALITÀ_FK
     foreign key (IDordine)
     references ORDINE (IDordine);

alter table PREFERITO add constraint FKAFFERENZA
     foreign key (IDprodotto)
     references PRODOTTO (IDprodotto);

alter table PREFERITO add constraint FKAGGIUNTA
     foreign key (usernameAcquirente)
     references ACQUIRENTE (username);

alter table OFFERTA add constraint FKPUBBLICA
     foreign key (usernameVenditore)
     references VENDITORE (username);

alter table OFFERTA add constraint FKINERENZA
     foreign key (categoria)
     references CATEGORIA (nome);

alter table OFFERTA add constraint FKRIGUARDO
     foreign key (marca)
     references MARCA (nome);

alter table SOTTOCATEGORIA add constraint FKINCLUSIONE
     foreign key (categoria)
     references CATEGORIA (nome);

alter table `RICEZIONE-ACQUIRENTE` add constraint FKnotifica
     foreign key (titoloNotifica)
     references `NOTIFICA-ACQUIRENTE` (titolo);

alter table `RICEZIONE-ACQUIRENTE` add constraint FKusernameAcquirente
     foreign key (usernameAcquirente)
     references ACQUIRENTE (username);

alter table `RICEZIONE-VENDITORE` add constraint FKRIC_NOT
     foreign key (titoloNotifica)
     references `NOTIFICA-VENDITORE` (titolo);

alter table `RICEZIONE-VENDITORE` add constraint FKRIC_VEN
     foreign key (usernameVenditore)
     references VENDITORE (username);


-- Categories
-- _____________ 

insert into CATEGORIA(nome, descrizione)
values (
     "make-up",
     "Il trucco è sempre stato e sempre sarà al centro della routine di bellezza della persona. Scopri ora il catalogo PureEssence e lasciati ispirare dalla nostra idea di make-up."
);

insert into CATEGORIA(nome, descrizione)
values (
     "viso",
     "La formula della bellezza passa per la cura del viso. Scopri la linea PureEssence e trova i trattamenti e i prodotti migliori per curare e valorizzare il tuo viso."
);

insert into CATEGORIA(nome, descrizione)
values (
     "capelli",
     "Che siano ricci, lisci, crespi o mossi, tutti cercano di trovare il miglior modo per valorizzare e curare i propri capelli. Scopri il catalogo PureEssence e trova il prodotto più giusto per te."
);

insert into CATEGORIA(nome, descrizione)
values (
     "corpo",
     "Nella routine di bellezza quotidiana, nulla è importante come la cura della pelle. Scopri la collezione di prodotti corpo PureEssence e trova tutto ciò di cui hai bisogno per una pelle perfetta."
);

insert into CATEGORIA(nome, descrizione)
values (
     "profumi",
     "Che sia per un'occasione speciale, o per la tua vita quotidiana, PureEssence ha il profumo giusto per te. Scopri il nostro catalogo e trova la migliore fragranza per le tue esigenze."
);

-- Seller profile
-- _____________

insert into VENDITORE(username, password, email, telefono)
values ("pureessence", "c7ad44cbad762a5da0a452f9e854fdc1e0e7a52a38015f23f3eab1d80b931dd472634dfac71cd34ebc35d16ab7fb8a90c81f975113d6c7538dc69dd8de9077ec", "admin@pureessence.it", "");
