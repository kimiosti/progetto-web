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

ALTER TABLE prodotto
ADD istruzioni_per_luso VARCHAR(300),
ADD ingredienti VARCHAR(300),
ADD avvertenze VARCHAR(150);

INSERT INTO `marca` (`nome`) VALUES
('CHANEL'),
('K18'),
('KERASTASE'),
('OLAPLEX'),
('REDKEN');

INSERT INTO `sottocategoria` (`nome`, `categoria`) VALUES
('Trattamenti Capelli', 'capelli'),
('Donna', 'profumi');


INSERT INTO `prodotto` (`IDprodotto`, `nome`, `didascalia`, `descrizione`, `URLimmagine`, `marca`, `sottocategoria`, `istruzioni_per_luso`, `ingredienti`, `avvertenze`) VALUES
(1, 'No.3 Hair Perfector™', 'Trattamento Settimanale Per Capelli', 'Un potente trattamento pre-shampoo dall’efficacia clinicamente testata, che rende i capelli 3 volte più forti dopo un solo utilizzo', 'capelli/trattamenti/olaplex/001.jpg', 'OLAPLEX', 'Trattamenti Capelli', NULL, NULL, NULL),
(2, 'ONE UNITED', 'Spray Leave-In per tutti i tipi di capelli ', 'Trattamento spray per capelli con 25 benefici che aumentano la maneggiabilità, la protezione e la bellezza. Offre benefici legati al trattamento per aumentarne la maneggiabilità, la protezione e la bellezza. Ammorbidisce la texture dei prodotti per la piega. Idrata e nutre il capello, contribuisce a levigare i capelli porosi, riduce la disidratazione dei capelli, li rende più lisci e scioglie i nodi.', 'capelli/trattamenti/redken/003.jpg', 'REDKEN', 'Trattamenti Capelli', 'Dopo lo shampoo, spruzzare uniformemente sui capelli umidi o tamponati con un asciugamano. Non risciacquare per ottenere un effetto condizionante profondo. Risciacquare dopo 1-2 minuti per un effetto condizionante leggero.', 'Aqua / Water / Eau, Cocos Nucifera Oil / Coconut Oil, Amodimethicone, Polyquaternium-37, Phenoxyethanol, Propylene Glycol Dicaprylate / Dicaprate, Parfum / Fragrance, Acetamide MEA, Lactamide MEA, Dimethicone PEG-7 Phosphate, PPG-1 Trideceth-6, Trideceth-6, Behentrimonium Chloride, Xylose', 'In caso di contatto con gli occhi, sciacquarli immediatamente e abbondantemente.'),
(3, 'Genesis Serum', 'Siero anti caduta temporanea', 'Siero fortificante anti-caduta occasionale per capelli indeboliti e propensi alla caduta da usare quotidianamente. Aumenta la resistenza del capello minimizzando la caduta occasionale, e rende i capelli più splendenti.', 'capelli/trattamenti/kerastase/002.jpg', 'KERASTASE', 'Trattamenti Capelli', NULL, NULL, NULL),
(4, 'K18', 'Repair Hair Mask ', 'Una maschera di trattamento leave-in per tutti i tipi di capelli, che ripara i danni in soli quattro minuti. K18PEPTIDE™ ripara i capelli danneggiati da decolorazioni, tinte per capelli, trattamenti chimici e calore, restituendo forza, morbidezza ed elasticità alla chioma.', 'capelli/trattamenti/k18/004.jpg', 'K18', 'Trattamenti Capelli', NULL, NULL, NULL),
(5, 'No.7 Bonding Oil', 'Olio Per Capelli', 'Un olio per lo styling altamente concentrato e leggero per tutti i tipi di capelli. Bastano 2 o 3 gocce per ottenere all’ istante più lucentezza e morbidezza, rafforzare i capelli per ridurre le rotture e controllare l’ effetto crespo e le ciocche ribelli per capelli visibilmente sani e in ordine.', 'capelli/trattamenti/olaplex/101.png', 'OLAPLEX', 'Trattamenti Capelli', NULL, NULL, NULL),
(6, 'N°5', 'Eau De Parfum', 'N°5, l’ essenza stessa della femminilità.\r\nUn bouquet fiorito-aldeidato, sublimato in un flacone iconico dalle linee minimaliste. Un profumo mitico e intramontabile. L’Eau de Parfum s’ispira all’ Estratto, con il quale condivide la firma fiorito-aldeidata. Questo bouquet fiorito, declinato intorno alla rosa di maggio e al gelsomino, è allegro e vivace grazie alle note di testa esperidate.', 'profumi/Donna/chanel/4243.jpg', 'CHANEL', 'Donna', 'L’ Eau de Parfum in versione vaporizzatore, per una gestualità ampia e semplice, sulla pelle o sui vestiti.', 'ALCOHOL | AQUA (WATER) | PARFUM (FRAGRANCE) | BENZYL ALCOHOL | BENZYL BENZOATE | BENZYL CINNAMATE | BENZYL SALICYLATE | CINNAMYL ALCOHOL | CITRAL | CITRONELLOL | COUMARIN | EUGENOL | FARNESOL | GERANIOL | HYDROXYCITRONELLAL | ISOEUGENOL | LIMONENE | LINALOOL | ALPHA-ISOMETHYL IONONE', 'Nessuna avvertenza.');


INSERT INTO `disponibilità` (`IDdisponibilità`, `taglia`, `prezzo`, `quantità`, `IDprodotto`, `usernameVenditore`) VALUES
(101, '100ml', 22, 8, 1, 'pureessence'),
(102, '400ml', 18, 10, 2, 'pureessence'),
(103, '90ml', 15, 50, 3, 'pureessence'),
(104, '50ml', 28, 20, 4, 'pureessence'),
(105, '30ml', 29, 30, 5, 'pureessence');
