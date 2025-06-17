-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 17/06/2025 às 14:14
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `biblioteca_mvc2`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `alunos`
--

CREATE TABLE `alunos` (
  `id` int(11) NOT NULL,
  `nome` varchar(40) NOT NULL,
  `email` varchar(100) NOT NULL,
  `salas` varchar(50) NOT NULL DEFAULT '',
  `turno` enum('manhã','tarde','noite') NOT NULL DEFAULT 'manhã'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `alunos`
--

INSERT INTO `alunos` (`id`, `nome`, `email`, `salas`, `turno`) VALUES
(1, 'duda', 'igorbizarro@hotmail.com', '9C', 'tarde'),
(7, 'Maria Eduarda Mota Dias', '00001102613800p@al.educacao.sp.gov.br', '3B', 'manhã'),
(8, 'Grasiella Cirilo ', 'grasizinha008@gmail.com', '3D', 'manhã'),
(9, 'João Pedro ', 'joaozinhopretinho@gmail.com', '3D', 'manhã'),
(10, 'Fernando Pinto', 'fernandinhopintinho69@gmail.com', '3G', 'noite'),
(11, 'Igor Rafael Moreira Borges da Silva', 'igorbizarro@hotmail.com', '7C', 'tarde'),
(12, 'Ana Diva', 'anajuliadiva@gmail.com', '3D', 'manhã');

-- --------------------------------------------------------

--
-- Estrutura para tabela `emprestimos`
--

CREATE TABLE `emprestimos` (
  `id` int(11) NOT NULL,
  `data_retirada` date NOT NULL,
  `data_devolucao` date NOT NULL,
  `status` tinyint(1) NOT NULL,
  `aluno_id` int(11) NOT NULL,
  `professor_id` int(11) NOT NULL,
  `livro_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `livros`
--

CREATE TABLE `livros` (
  `id` int(11) NOT NULL,
  `nome_livro` varchar(100) NOT NULL,
  `nome_autor` varchar(40) NOT NULL,
  `isbn` int(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `livros`
--

INSERT INTO `livros` (`id`, `nome_livro`, `nome_autor`, `isbn`) VALUES
(4, '1', '1', 0),
(5, 'é assim que acaba', 'Colleen Hoover', 0),
(6, 'O Pequeno Princípe', ' Antoine De Saint-exupéry, Jamila Mafra,', 0),
(7, 'Textos cruéis demais para serem lidos rapidamente – Onde dorme o amor', 'Igor Pires, Gabriela Barreira, Leticia N', 0),
(8, 'Heróis da fé', 'Orlando Boyer', 0),
(9, 'Este livro é gay', 'James Dawson', 0),
(10, 'Até o verão terminar', 'Colleen Hoover', 0),
(11, 'Heróis da fé', 'James Dawson', 0),
(12, 'Heróis da fé', 'James Dawson', 0),
(13, 'O Resto de Mim', 'Ashley Munoz', 0),
(14, 'Um de nós está mentindo', 'Karen McManus', 2147483647),
(15, 'Para todos os garotos que já amei', 'Jenny Han', 2147483647),
(16, 'Em chamas', 'Suzanne Collins', 2147483647),
(17, 'Sobrevivendo no inferno', 'Racionais MC\'s', 2147483647),
(18, 'Box Peter Pan', 'J.M. Barrie', 2147483647),
(19, 'Em chamas', 'Suzanne Collins', 2147483647),
(20, 'Em chamas', 'Suzanne Collins', 2147483647),
(21, 'Harry Potter e a Câmara Secreta', 'J.K. Rowling', 2147483647),
(22, 'ANIMAIS FANTÁSTICOS E ONDE HABITAM: O ROTEIRO ORIGINAL', 'J.K. Rowling', 2147483647),
(23, 'Em chamas', 'Suzanne Collins', 2147483647);

-- --------------------------------------------------------

--
-- Estrutura para tabela `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `professores`
--

CREATE TABLE `professores` (
  `id` int(11) NOT NULL,
  `nome` varchar(40) NOT NULL,
  `cpf` varchar(11) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `professores`
--

INSERT INTO `professores` (`id`, `nome`, `cpf`, `senha`, `email`) VALUES
(57, 'Nersinho', '98765432169', '$2y$10$3GF.EhtZmC802AADei1G6e7hC8CR6.tjC1eAefYIPhc.3bIpFfUt6', 'joaonersinhobroxa@gmail.com'),
(58, 'Maria Maravilhosa', '25814736900', '$2y$10$LcKitNbOy38K9gD6duzcku6XvP90wTFjfKpZiLVMVxzatmfKUZNie', 'mariaeduardadossantos2008@gmail.com'),
(59, 'joao', '21212121212', '$2y$10$S4t8f32mw7hnVqIMqHyo3ejfpabqnPhyQRjmS9CwEt.UTBXWMLiBy', 'mariaeduardadossantos2008@gmail.com'),
(60, 'Fernando ', '12345678900', '$2y$10$iUB56Y0JwlHJ7RHuGHpKse.ScWEjf59US7uGPrRjmxeEoI3V11kta', 'fernandoprofessor2@gmail.com'),
(61, 'Fernando ', '12345678900', '$2y$10$wGQ8hHfF2OJjVOpC.Pl2FubmJDR3pde6hu75QjvrK6xxDdv28PVq2', 'fernandoprofessor2@gmail.com'),
(62, 'Fernando ', '12345678900', '$2y$10$yBwQ.o6jCeXC9NbNnp2a5O76J.J5O78ACQGBSMCY3eLNQ0EJ5guKG', 'fernandoprofessor2@gmail.com'),
(63, 'Fernando ', '11122233345', '$2y$10$d7WNOpDBTHUuC9jMHcq5tu4xNQn70/HqJsijJFeno5WEi0Oruo7Xq', 'mariaeduardadossantos2008@gmail.com'),
(64, 'Gabriel', '14725836900', '$2y$10$Y9CMUmbtAcfAb0OYZgfCM.vZ5/kEvPrUFO8PWsRU1XbjH26O5yOTi', 'gabrielprofessor1@gmail.com'),
(65, 'Gabriel', '12345678900', '$2y$10$fZcp0ReBKRAh6rgK3IbhiucC2EqGyZEd6ehg8gIkHsCyBg5dLc71q', 'mariaeduardadossantos2008@gmail.com'),
(66, 'Gabriel', '12345678900', '$2y$10$QptJLCVmVoJ7m0GXBde0GODgc/BZ60cWHV86QvNYgNKJpPOrYhmGm', 'mariaeduardadossantos2008@gmail.com'),
(67, 'Fernando ', '12345678900', '$2y$10$.A/RpeQCUxgHa3Ue1OCSfujZU.LKwzwK9jFV5EuWCNf5dKzVPDTEG', 'mariaeduardadossantos2008@gmail.com'),
(68, 'Fernando ', '12345678900', '$2y$10$WauRrLgWUXCBsPZQP9pKFOwnG7rfsfo4857bRXLyvU3yHOCuuTAP6', 'mariaeduardadossantos2008@gmail.com'),
(69, 'Fernando ', '12345678900', '$2y$10$xhK7InEGvAbhGfT3HPtZkOWfkSXeo0vcEv0jcC23kujRC0R5eLPZm', 'fernandoprofessor2@gmail.com');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `alunos`
--
ALTER TABLE `alunos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `emprestimos`
--
ALTER TABLE `emprestimos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `aluno_id` (`aluno_id`),
  ADD KEY `professor_id` (`professor_id`),
  ADD KEY `livro_id` (`livro_id`);

--
-- Índices de tabela `livros`
--
ALTER TABLE `livros`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `professores`
--
ALTER TABLE `professores`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `alunos`
--
ALTER TABLE `alunos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `emprestimos`
--
ALTER TABLE `emprestimos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de tabela `livros`
--
ALTER TABLE `livros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de tabela `professores`
--
ALTER TABLE `professores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `emprestimos`
--
ALTER TABLE `emprestimos`
  ADD CONSTRAINT `aluno_id` FOREIGN KEY (`aluno_id`) REFERENCES `alunos` (`id`),
  ADD CONSTRAINT `livro_id` FOREIGN KEY (`livro_id`) REFERENCES `livros` (`id`),
  ADD CONSTRAINT `professor_id` FOREIGN KEY (`professor_id`) REFERENCES `professores` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
