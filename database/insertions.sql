use pureessence;
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

INSERT INTO `marca` (`nome`) VALUES ('CHANEL');
INSERT INTO `sottocategoria` (`nome`, `categoria`) VALUES ('Donna', 'profumi');
INSERT INTO `prodotto` (`IDprodotto`, `nome`, `didascalia`, `descrizione`, `URLimmagine`, `marca`, `sottocategoria`, `istruzioni`, `ingredienti`, `avvertenze`) VALUES ('6', 'N°5', 'Eau De Parfum', 'N°5, UN essenza stessa della femminilità.\r\nUn bouquet fiorito-aldeidato, sublimato in un flacone iconico dalle linee minimaliste. Un profumo mitico e intramontabile. Eau de Parfum siispira all’Estratto, con il quale condivide la firma fiorito-aldeidata. Questo bouquet fiorito, declinato intorno alla rosa di maggio e al gelsomino, è allegro e vivace grazie alle note di testa esperidate.', 'profumi/Donna/chanel/4243.jpg', 'CHANEL', 'Donna', 'L’Eau de Parfum in versione vaporizzatore, per una gestualità ampia e semplice, sulla pelle o sui vestiti.', 'ALCOHOL | AQUA (WATER) | PARFUM (FRAGRANCE) | BENZYL ALCOHOL | BENZYL BENZOATE | BENZYL CINNAMATE | BENZYL SALICYLATE | CINNAMYL ALCOHOL | CITRAL | CITRONELLOL | COUMARIN | EUGENOL | FARNESOL | GERANIOL | HYDROXYCITRONELLAL | ISOEUGENOL | LIMONENE | LINALOOL | ALPHA-ISOMETHYL IONONE', 'Nessuna avvertenza.');