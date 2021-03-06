DROP DATABASE IF EXISTS restaurant;
CREATE DATABASE restaurant;
USE restaurant;

-- Struttura della tabella `Luogo`

CREATE TABLE `Luogo`
(
  `IDLuogo` bigint PRIMARY KEY AUTO_INCREMENT,
  `Comune` varchar(40) NOT NULL,
  `Provincia` char(2) NOT NULL,
  `Via` varchar(40) NOT NULL,
  `N_Civico` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Struttura della tabella `Ristorante`

CREATE TABLE `Ristorante`
(
    `Nome` varchar(30) NOT NULL,
    `Cellulare` varchar(13) NOT NULL,
    `TelefonoFisso` varchar(13) NOT NULL,
    `Proprietario` varchar(80) NOT NULL,
    `GiorniDiApertura` longtext NOT NULL,
    `EntitaScontoBase` float NOT NULL,
    `EntitaScontoAPunti` float NOT NULL,
    `IDLuogo` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Struttura della tabella `Utente`

CREATE TABLE `Utente`
(
    `Nome` varchar(40) NOT NULL,
    `Cognome` varchar(40) NOT NULL,
    `NomeUtente` varchar(20) NOT NULL,
    `Email` varchar(255) UNIQUE NOT NULL,
    `Telefono` varchar(13) NOT NULL,
    `Password` varchar(200) NOT NULL,
    `Punti` smallint,
    `OrdiniCumulati` smallint,
    `DataUltimoOrdine` date,
    PRIMARY KEY (`NomeUtente`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Struttura della tabella `Ordine`

CREATE TABLE `Ordine`
(
    `IDOrdine`         bigint PRIMARY KEY AUTO_INCREMENT,
    `DataOrdinazione`  datetime    NOT NULL,
    `DataConsegna`     datetime    NOT NULL,
    `Nota`             varchar(600),
    `PrezzoTotale`     float       NOT NULL,
    `TipoPagamento`    varchar(8)  NOT NULL,
    `PuntiUsati`       smallint NOT NULL,
    `TelefonoConsegna` varchar(13),
    `NomeUtente`       varchar(20) NOT NULL,
    `IDLuogo`          bigint   NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Struttura della tabella `Prodotto`

CREATE TABLE `Prodotto`
(
    `Nome` varchar(50) NOT NULL UNIQUE,
    `IDProdotto` smallint PRIMARY KEY AUTO_INCREMENT,
    `Prezzo` float NOT NULL,
    `Descrizione` varchar(250),
    `Ingredienti` varchar(500) NOT NULL,
    `Biologico` bit(1),
    `Categoria` varchar(10) NOT NULL,
    `Congelato` bit(1) DEFAULT 0,
    `Vegano` bit(1) DEFAULT 0,
    `Glutine` bit(1) DEFAULT 0,
    `Integrale` bit(1) DEFAULT 0,
    `GradoAlcolico` float,
    `Gassato` bit(1),
    `Disponibilita` bit(1)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Struttura della tabella `É composto da`

CREATE TABLE `E_composto_da`
(
    `IDOrdine` bigint,
    `IDProdotto` smallint,
    `Quantita` tinyint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Indici per la tabella `Ristorante`

ALTER TABLE `Ristorante`
  ADD PRIMARY KEY (`Nome`),
  ADD KEY `ha_sede_in` (`IDLuogo`);

-- Limiti per la tabella `Ristorante`

ALTER TABLE `Ristorante`
  ADD CONSTRAINT `ha_sede_in` FOREIGN KEY (`IDLuogo`) REFERENCES `Luogo` (`IDLuogo`) ON DELETE CASCADE ON UPDATE CASCADE;

-- Indici per la tabella `Ordine`

ALTER TABLE `Ordine`
    ADD KEY `ha effettuato` (`NomeUtente`),
    ADD KEY `va consegnato in` (`IDLuogo`);

-- Limiti per la tabella `Ordine`

ALTER TABLE `Ordine`
    ADD CONSTRAINT `ha effettuato` FOREIGN KEY (`NomeUtente`) REFERENCES `Utente` (`NomeUtente`) ON DELETE CASCADE ON UPDATE CASCADE,
    ADD CONSTRAINT `va consegnato in` FOREIGN KEY (`IDLuogo`) REFERENCES `Luogo` (`IDLuogo`) ON DELETE CASCADE ON UPDATE CASCADE;

-- Indici per la tabella `É_composto_da`

ALTER TABLE `E_composto_da`
    ADD PRIMARY KEY (`IDOrdine`, `IDProdotto`),
    ADD KEY `relativo a` (`IDProdotto`),
    ADD KEY `composto da` (IDOrdine);

-- Limiti per la tabella `E_composto_da`

ALTER TABLE `E_composto_da`
    ADD CONSTRAINT `relativo a` FOREIGN KEY (`IDProdotto`) REFERENCES `Prodotto` (`IDProdotto`) ON DELETE CASCADE ON UPDATE CASCADE,
    ADD CONSTRAINT `composto da` FOREIGN KEY (`IDOrdine`) REFERENCES `Ordine` (`IDOrdine`) ON DELETE CASCADE ON UPDATE CASCADE;