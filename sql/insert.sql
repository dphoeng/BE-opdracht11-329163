INSERT INTO `Voertuig` (`Id`, `Kenteken`, `Type`, `Bouwjaar`, `Brandstof`, `TypeVoertuigId`) VALUES 
(null, 'AU-67-IO', 'Golf', '2017-06-12', 'Diesel', 1), 
(null, 'TR-24-OP', 'DAF', '2019-05-23', 'Diesel', 2), 
(null, 'TH-78-KL', 'Mercedes', '2023-01-01', 'Benzine', 1), 
(null, '90-KLTR', 'Fiat 500', '2021-09-12', 'Benzine', 1), 
(null, '34-TK-LP', 'Scania', '2015-03-13', 'Diesel', 2), 
(null, 'YY-OP-78', 'BMW M5', '2022-05-12', 'Diesel', 1), 
(null, 'UU-HH-JK', 'M.A.N', '2017-12-03', 'Diesel', 2), 
(null, 'ST-FZ-28', 'Citroën', '2018-01-20', 'Diesel', 1), 
(null, '123-FR-T', 'Piaggio ZIP', '2021-02-01', 'Benzine', 4), 
(null, 'DRS-52-P', 'Vespa', '2022-03-21', 'Benzine', 4), 
(null, 'STP-12-U', 'Kymco', '2022-07-02', 'Benzine', 4), 
(null, '45-SD-23', 'Renault', '2023-01-01', 'Diesel', 3)

INSERT INTO `Instructeur` (`Id`, `Voornaam`, `Tussenvoegsel`, `Achternaam`, `Mobiel`, `DatumInDienst`, `AantalSterren`) VALUES 
(null, 'Li', null, 'Zhan', '06-28493827', '2015-04-17', 3),
(null, 'Leroy', null, 'Boerhaven', '06-39398734', '2018-06-25', 1),
(null, 'Yoeri', 'Van', 'Veen', '06-24383291', '2010-05-12', 3),
(null, 'Bert', 'Van', 'Sali', '06-48293823', '2023-01-10', 4),
(null, 'Mohammed', 'El', 'Yassidi', '06-34291234', '2010-06-14', 5)

INSERT INTO `VoertuigInstructeur` (`Id`, `VoertuigId`, `InstructeurId`, `DatumToekenning`) VALUES 
(null, 1, 5, '2017-06-18'),
(null, 3, 1, '2021-09-26'),
(null, 9, 1, '2021-09-27'),
(null, 3, 4, '2022-08-01'),
(null, 5, 1, '2019-08-30'),
(null, 10, 5, '2020-02-02')