--
-- Dump dei dati per la tabella `Prodotto`
--

INSERT INTO `Prodotto` (`Nome`, `Prezzo`, `Descrizione`, `Ingredienti`, `Biologico`, `Categoria`, `Congelato`, `Vegano`, `Glutine`, `Integrale`, `GradoAlcolico`, `Gassato`, `Disponibilita`) VALUES
('Spaghetti alla amatriciana',9,NULL,"Spaghetti, pomodori pelati, guanciale, pecorino romano D.O.C.G. , sale fino, olio extravergine d'oliva D.O.C.G di Moscufo, peperoncino fresco, vino bianco D.O.C.G di origine abruzzese",1,'Primi',0,0,1,0,NULL,NULL,NULL),
('Pappardelle al rag&ugrave di cinghiale',11,'Pasta fresca fatta in casa',"Pappardelle all'uovo, carne di cinghiale, passata di pomodoro, vino rosso D.O.C.G di origine abruzzese, cipolle, sedano, carote, olio extravergine d'oliva D.O.C.G di Moscufo, aglio, rosmarino, alloro, sale fino, pepe nero",1,'Primi',0,0,1,0,NULL,NULL,NULL),
('Gnocchi al rag&ugrave; di salsiccia',7,'Pasta fresca fatta in casa',"Gnocchi, passata di pomodoro, salsiccia, carote, sedano,cipolle bianche D.O.C.G. , vino rosso D.O.C.G Montepulciano D'Abruzzo, concentrato di pomodoro, brodo vegetale, zucchero, origano, sale fino, pepe nero,olio extravergine d'oliva D.O.C.G di Moscufo",1,'Primi',0,0,1,0,NULL,NULL,NULL),
('Fettuccine al tartufo',13,'Pasta fresca fatta in casa e tartufo di produzione propria',"Fettuccine all'uovo, tartufo nero, aglio, olio extravergine d'oliva D.O.C.G di Moscufo, sale fino, margarina",1,'Primi',0,1,1,1,NULL,NULL,NULL),
('Spaghetti alle vongole',11,NULL,"Spaghetti, vongole, aglio, prezzemolo, olio extravergine d'oliva D.O.C.G di Moscufo, pepe nero, sale fino, sale grosso",0,'Primi', 0,0,0,0,NULL,NULL,NULL),
('Spaghetti alle cozze',11.50,NULL,"Spaghetti, cozze, passata di pomodoro, olio extravergine d'oliva D.O.C.G di Moscufo, aglio, prezzemolo, pepe nero",0,'Primi',0,0,1,0,NULL,NULL,NULL),
('Bruschette al tartufo con prosciutto crudo',6.50,'Pane di produzione locale e tartufo di produzione propria','Pane, tartufo bianco e nero, prosciutto crudo D.O.C.G. di Parma',1,'Antipasti',0,0,1,0,NULL,NULL,NULL),
("Olive all'ascolana", 4,NULL,"Olive ascolane tenere, carne di manzo, carne di maiale, carne di pollo, pane, cipolle, noce moscata, parmigiano reggiano D.O.C.G. dell'Emilia Romagna, scorza di limone, chiodi di garofano, carote, sedano, vino bianco D.O.C.G di origine abbruzzese, uova, sale fino",1,'Antipasti',1,0,1,1,NULL,NULL,NULL),
    ('Pane con formaggio fresco spalmabile e funghi', 5, 'Pane di produzione locale e funghi di produzione propria','Pane, formaggio fresco, funghi',1,'Antipasti',0,0,1,1,NULL,NULL,NULL),
    ('Tagliere di salumi e formaggi',20,'Per due persone',"Prosciutto cotto D.O.C.G. della Lombardia, pecorino D.O.C.G. di origine abruzzese, spianata romana D.O.C.G., corallina D.O.C.G., salame ungherese, culatello, lonza, prosciutto crudo D.O.C.G. di Parma, parmigiano reggiano 40 mesi D.O.C.G. dell'Emilia Romagna, asiago D.O.C.G. della Campania",1,'Antipasti',0,0,1,0,NULL,NULL,NULL),
('Arrosticini (10 pezzi)', 10, 'Porzione da 10 pezzi', "Carne di pecora, sale fino", 1, 'Secondi', 1, 0, 0, 0, NULL,
 NULL, NULL),
    ('Bistecca alla fiorentina',37,'Porzione da 1 Kg', "Carne di manzo, olio extravergine d'oliva D.O.C.G di Moscufo, sale fino",1,'Secondi',0,0,0,0,NULL,NULL,NULL),
    ('Spigola al forno',20,'Spigola del Mar Tirreno', "Spigola, cipolle, carote, olio extravergine d'oliva D.O.C.G di Moscufo, sedano, salvia, basilico, prezzemolo, aglio, alloro, pepe nero, pomodorini ciliegini D.O.C.G. , vino bianco D.O.C.G di origine abruzzese",0,'Secondi',0,0,0,0,NULL,NULL,NULL),
    ('Insalata di calamari',15,'Calamari del Mediterraneo',"Calamari, olio extravergine d'oliva D.O.C.G di Moscufo, sedano, prezzemolo, alloro, vino bianco D.O.C.G di origine abruzzese", 0,'Secondi', 0,0,0,0,NULL,NULL,NULL),
('Straccetti di pollo',7.50, NULL, "Petto di pollo, olio extravergine d'oliva D.O.C.G di Moscufo, aglio, sale fino, pepe nero, vino bianco D.O.C.G di origine abruzzese, prezzemolo, farina 00",1,'Secondi',0,0,1,0,NULL,NULL,NULL),
('Patate al forno',4.50, NULL, "Patate D.O.C.G. di Avezzano, rosmarino, olio extravergine d'oliva D.O.C.G di Moscufo, aglio, sale rosso delle Hawaii",1,'Contorni',0,1,0,0,NULL,NULL,NULL),
('Insalata croccante',3,NULL,"Insalata iceberg, parmigiano reggiano 40 mesi D.O.C.G. dell'Emilia Romagna, carote, prezzemolo, pancarr&egrave;, acciughe, aceto di vino bianco D.O.C.G di origine abruzzese, sale fino, pepe nero, olio extravergine d'oliva D.O.C.G di Moscufo",1,'Contorni',0,0,1,0,NULL,NULL,NULL),
('Patatine fritte', 2.50, 'Con patate fresche', 'Patate D.O.C.G. di Avezzano, sale fino',1,'Contorni',0,1,0,0,NULL,NULL,NULL),
('Verdure miste',3.50,'Verdure fresche grigliate', 'Melanzane, zucchine, peperoni', 1, 'Contorni',0,1,0,0,NULL,NULL,NULL),
('Pizza margherita',5,'Cottura con forno a legna',"Farina 00, acqua, olio extravergine d'oliva D.O.C.G di Moscufo, sale fino, lievito di birra, polpa di pomodoro, mozzarella fiordilatte D.O.C.G. campana, origano, basilico",1,'Pizze',0,0,1,1,NULL,NULL,NULL),
('Pizza 4 formaggi',7.50,'Cottura con forno a legna', "Farina di riso, amido di mais, miele, acqua, sale fino, lievito di birra fresco, olio extravergine d'oliva D.O.C.G di Moscufo, gorgonzola, scamorza, quartirolo lombardo", 1,'Pizze',0,0,1,0,NULL,NULL,NULL),
('Pizza marinara',4.50,'Cottura con forno a legna',"Farina 00, acqua, olio extravergine d'oliva D.O.C.G di Moscufo, sale fino, lievito di birra, passata di pomodoro, aglio, origano, pepe nero",1,'Pizze',0,1,0,1,NULL,NULL,NULL),
('Pizza wurstel e mais',4.50,'Cottura con forno a legna',"Farina 00, acqua, olio extravergine d'oliva D.O.C.G di Moscufo, sale fino, passata di pomodoro, lievito di birra, mais, wurstel",0,'Pizze', 0,0,1,0,NULL,NULL,NULL),
('Pizza con patate',4.50,'Cottura con forno a legna',"Farina 00, acqua, olio extravergine d'oliva D.O.C.G di Moscufo, sale fino, passata di pomodoro, lievito di birra, patate D.O.C.G. di Avezzano",1,'Pizze',0,1,1,0,NULL,NULL,NULL),
('Tiramis&ugrave',3,'Produzione artigianale','Savoiardi, uova, mascarpone, zucchero, caff&egrave;, cacao amaro',0,'Dolci',0,0,0,0,NULL,NULL,NULL),
('Crema catalana',4,'Produzione artigianale','Latte, uova, zucchero, limone, cannella, amido di mais', 0,'Dolci',0,0,1,0,NULL,NULL,NULL),
('Cheesecake alla nutella',4.50,'Produzione artigianale', 'Biscotti, burro, nutella, formaggio fresco, nocciole', 0,'Dolci', 0,0,1,0,NULL,NULL,NULL),
('Cake pops alla nutella',5,'Produzione artigianale', 'Albicocche, pan di spagna, cioccolato bianco, cioccolato fondente, cocco rap&egrave;, nocciole, zucchero', 0,'Dolci',0,1,1,0,NULL,NULL,NULL),
('Muffin fantasma',3.5,'Produzione artigianale', 'Burro, farina 00, uova, vaniglia, zucchero, lievito in polvere, latte, cioccolato bianco, cioccolato fondente',0,'Dolci',0,0,1,0, NULL,NULL,NULL),
('Coca cola',2,'Lattina da 33 cl','zucchero, colorante E150D, aromi naturali, caffeina, acido fosforico (E 338)',0,'Bevande',NULL,NULL,NULL,0,0,1,1),
('Coca cola zero',2,'Lattina da 33 cl', 'Colorante E150D, acido fosforico (E 338), aromi naturali, caffeina, correttore di acidit&agrave;: citrato trisodico, edulcoranti: ciclammato di sodio, acesulfame K e aspartame',0,'Bevande',NULL,NULL,NULL,NULL,0,1,0),
('Acqua minerale naturale',1.5,'Bottiglia da 1l','Acqua, sali minerali',NULL,'Bevande',NULL,NULL,NULL,NULL,0,1,1),
('Birra alla spina da 0.75 cl',3,'Produzione artigianale',"Malto, luppoli, cereali non maltati, spezie, mosto d'uva",0,'Bevande',NULL,NULL,NULL,NULL,13.5,0,1),
('Succo di frutta alla pera Yoga',2,'Bottiglietta da 0.5l','Acido ascorbico, sciroppo di glucosio, sciroppo di fruttosio, zucchero, pera (purea, succo e succo concentrato), aromi',1,'Bevande',NULL,NULL,NULL,NULL,0,0,1);

--
-- Dump dei dati per la tabella `Luogo`
--

INSERT INTO `Luogo` (`Comune`, `Provincia`, `Via`, `N_Civico`) VALUES ("L'Aquila", 'AQ', 'Germania', '4');

--
-- Dump dei dati per la tabella `Ristorante`
--

INSERT INTO `Ristorante` (`Nome`, `Cellulare`, `TelefonoFisso`, `Proprietario`, `GiorniDiApertura`, `EntitaScontoBase`, `EntitaScontoAPunti`, `IDLuogo`) VALUES ('IL RISTORANTE', '3431938211', '0862782133', 'Giacomo Palla', 'lunedi=si=martedi=no=mercoledi=si=giovedi=no=venerdi=si=sabato=no=domenica=si', '10', '1', '1');