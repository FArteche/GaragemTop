CREATE TABLE Usuario (
    Id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL -- A senha será armazenada com hash
);

CREATE TABLE Categoria (
    Id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50) NOT NULL
);

CREATE TABLE Veiculo (
    Id INT AUTO_INCREMENT PRIMARY KEY,
    id_categoria INT NOT NULL,
    placa VARCHAR(10) UNIQUE,
    modelo VARCHAR(100) NOT NULL,
    marca VARCHAR(50),
    cor VARCHAR(30),
    ano INT,
    imagem VARCHAR(255), -- Caminho para o arquivo da imagem
    descricao TEXT,
    data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_categoria) REFERENCES Categoria(Id) ON DELETE CASCADE
);

INSERT INTO Categoria (Id, nome) VALUES
(1, 'Caminhões'),
(2, 'Camionetes'),
(3, 'SUVs'),
(4, 'Veículos de Passeio'),
(5, 'Motos');

INSERT INTO `Veiculo` (`id_categoria`, `placa`, `modelo`, `marca`, `cor`, `ano`, `imagem`, `descricao`) VALUES
(2, 'SDF1A23', 'Hilux', 'Toyota', 'Prata', 2023, 'hilux_prata.jpg', 'Camionete robusta e confiável, ideal para trabalho e lazer. Versão SRX com tração 4x4 e câmbio automático.'),
(4, 'RGH4B56', 'Onix', 'Chevrolet', 'Vermelho', 2024, 'onix_vermelho.jpg', 'Veículo de passeio líder de vendas. Econômico, ágil na cidade e com central multimídia MyLink.'),
(1, 'JKL8C90', 'R450', 'Scania', 'Azul', 2019, 'scania_r450.jpg', 'Caminhão pesado de alta performance para longas distâncias. Cabine leito, com muito conforto para o motorista.'),
(3, 'QWE5D67', 'Renegade', 'Jeep', 'Branco', 2022, 'renegade_branco.jpg', 'SUV compacto com design icônico e capacidade off-road. Versão Longitude com motor turbo flex.'),
(2, 'TYU2E34', 'Ranger', 'Ford', 'Preto', 2022, 'ranger_preta.jpg', 'Uma picape forte e tecnológica. Ótima para quem busca aventura sem abrir mão do conforto.'),
(4, 'POI9F87', 'Civic', 'Honda', 'Cinza Chumbo', 2021, 'civic_cinza.jpg', 'Sedan com design esportivo e dirigibilidade excepcional. Versão Touring com motor 1.5 Turbo.'),
(3, 'MNB6G78', 'Creta', 'Hyundai', 'Prata', 2023, 'creta_prata.jpg', 'SUV moderno e espaçoso, repleto de tecnologia e com um amplo porta-malas. Ideal para a família.'),
(4, 'VCS3H45', 'Mobi', 'Fiat', 'Branco', 2020, 'mobi_branco.jpg', 'Carro urbano super compacto e eficiente. Perfeito para o dia a dia, fácil de manobrar e estacionar.'),
(5, 'ZXC7J65', 'CG 160 Titan', 'Honda', 'Azul Metálico', 2024, 'cg160_azul.jpg', 'A moto mais vendida do Brasil. Confiabilidade, economia e baixo custo de manutenção. Perfeita para o trabalho e locomoção diária.'),
(3, 'FGH1K23', 'Compass', 'Jeep', 'Vinho', 2021, 'compass_vinho.jpg', 'Um SUV sofisticado que combina luxo, conforto e performance. Interior em couro e teto solar panorâmico.');