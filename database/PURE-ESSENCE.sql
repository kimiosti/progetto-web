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
     IDprodotto int not null auto_increment,
     nome varchar(100) not null,
     didascalia varchar(300) not null,
     descrizione varchar(1500) not null,
     URLimmagine varchar (256) not null,
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
     IDdisponibilità int not null auto_increment,
     taglia varchar(5) not null,
     prezzo float not null,
     quantità int not null,
     IDprodotto int not null,
     usernameVenditore varchar(50) not null,
     constraint IDDISPONIBILITÀ primary key (IDdisponibilità));

create table ORDINE (
     IDordine int not null auto_increment,
     stato enum('carrello', 'pagato', 'pronto', 'in consegna', 'consegnato') not null default 'carrello',
     usernameAcquirente varchar(50) not null,
     constraint IDORDINE primary key (IDordine));

create table INCLUSIONE (
     IDdisponibilità int not null,
     IDordine int not null,
     quantità int not null,
     constraint IDINCLUSIONE primary key (IDdisponibilità, IDordine));

create table PAGAMENTO (
     IDordine int not null,
     data date not null,
     prezzo float(1) not null,
     constraint IDPAGAMENTO primary key (IDordine));

create table PREFERITO (
     usernameAcquirente varchar(50) not null,
     IDprodotto int not null,
     constraint IDPREFERITO primary key (usernameAcquirente, IDprodotto));

create table CATEGORIA (
     nome varchar(50) not null,
     descrizione tinytext not null,
     constraint IDCATEGORIA primary key (nome));

create table OFFERTA (
     IDofferta int not null auto_increment,
     URLcopertina varchar(50) not null,
     didascalia varchar(100) not null,
     descrizione varchar(1500) not null,
     percentuale int not null,
     spedizioneGratis boolean not null,
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
     constraint IDSOTTOCATEGORIA primary key (nome, categoria));

create table `NOTIFICA-ACQUIRENTE` (
     IDnotifica int not null auto_increment,
     titolo varchar(50) not null,
     contenuto varchar(256) not null,
     letto boolean not null default false,
     data date not null,
     IDordine int,
     IDdisponibilità int,
     usernameAcquirente varchar(50) not null,
     constraint `IDNOTIFICA-ORDINE-ACQUIRENTE` primary key (IDnotifica));

create table `NOTIFICA-VENDITORE` (
     IDnotifica int not null auto_increment,
     titolo varchar(50) not null,
     contenuto varchar(256) not null,
     letto boolean not null default false,
     data date not null,
     IDordine int,
     IDdisponibilità int,
     usernameVenditore varchar(50) not null,
     constraint `IDNOTIFICA-ORDINE-VENDITORE` primary key (IDnotifica));

create table `NOTIFICA-DISPONIBILITÀ-ACQUIRENTE` (
     IDnotifica int not null auto_increment,
     titolo varchar(50) not null,
     contenuto varchar(256) not null,
     letto boolean not null default false,
     data date not null,
     IDdisponibilità int not null,
     usernameAcquirente varchar(50) not null,
     constraint `IDNOTIFICA-ORDINE-VENDITORE` primary key (IDnotifica));

create table `NOTIFICA-DISPONIBILITÀ-VENDITORE` (
     IDnotifica int not null auto_increment,
     titolo varchar(50) not null,
     contenuto varchar(256) not null,
     letto boolean not null default false,
     data date not null,
     IDdisponibilità int not null,
     usernameVenditore varchar(50) not null,
     constraint `IDNOTIFICA-ORDINE-VENDITORE` primary key (IDnotifica));


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

alter table `NOTIFICA-ACQUIRENTE` add constraint FKNOTIFICAORDINEACQUIRENTE
     foreign key (IDordine)
     references ORDINE (IDordine);

alter table `NOTIFICA-ACQUIRENTE` add constraint FKNOTIFICAACQUIRENTEACQUIRENTE
     foreign key (usernameAcquirente)
     references ACQUIRENTE (username);

alter table `NOTIFICA-ACQUIRENTE` add constraint FKNOTIFICADISPONIBILITÀACQUIRENTE
     foreign key (IDdisponibilità)
     references DISPONIBILITÀ (IDdisponibilità);

alter table `NOTIFICA-VENDITORE` add constraint FKNOTIFICAORDINEVENDITORE
     foreign key (IDordine)
     references ORDINE (IDordine);

alter table `NOTIFICA-VENDITORE` add constraint FKNOTIFICAVENDITOREVENDITORE
     foreign key (usernameVenditore)
     references VENDITORE (username);

alter table `NOTIFICA-VENDITORE` add constraint FKNOTIFICADISPONIBILITÀVENDITORE
     foreign key (IDdisponibilità)
     references DISPONIBILITÀ (IDdisponibilità);
