DROP DATABASE IF EXISTS restaurant;
CREATE DATABASE restaurant;
USE restaurant;

/*Creazione tabella luogo e ristorante, da completare per le altre tabelle*/



--
-- Struttura della tabella `Luogo`
--

CREATE TABLE `Luogo` (
  `IDLuogo` bigint(9) PRIMARY KEY AUTO_INCREMENT,
  `Comune` varchar(40) NOT NULL,
  `Provincia` char(2) NOT NULL,
  `Via` varchar(40) NOT NULL,
  `N_Civico` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `Luogo`
--

INSERT INTO `Luogo` (`Comune`, `Provincia`, `Via`, `N_Civico`) VALUES
('L\'Aquila', 'AQ', 'Germania', '4'),
('Pescara', 'PE', 'Rome', '14/a');

-- --------------------------------------------------------

--
-- Struttura della tabella `Ristorante`
--

CREATE TABLE `Ristorante` (
  `Nome` varchar(30) NOT NULL,
  `Cellulare` varchar(13) NOT NULL,
  `TelefonoFisso` varchar(13) NOT NULL,
  `Proprietario` varchar(80) NOT NULL,
  `GiudizioComplessivo` float NOT NULL,
  `StatoApertura` bit(1) NOT NULL,
  `GiorniDiApertura` longtext NOT NULL,
  `AvvisiAttivi` bit(1) NOT NULL,
  `ChiusoStraordinario` bit(1) NOT NULL,
  `PromozioniAttive` text NOT NULL,
  `EntitaScontoBase` float NOT NULL,
  `EntitaScontoAPunti` float NOT NULL,
  `IDLuogo` bigint(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



CREATE TABLE `Ordine` (
    `IDOrdine` bigint(9) PRIMARY KEY AUTO_INCREMENT,
    `DataOrdinazione` DATETIME,
    `DataConsegna` DATETIME,

)


--
-- Indici per le tabelle `Ristorante`
--
ALTER TABLE `Ristorante`
  ADD PRIMARY KEY (`Nome`),
  ADD KEY `ha_sede_in` (`IDLuogo`);

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `Ristorante`
--
ALTER TABLE `Ristorante`
  ADD CONSTRAINT `ha_sede_in` FOREIGN KEY (`IDLuogo`) REFERENCES `Luogo` (`IDLuogo`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

