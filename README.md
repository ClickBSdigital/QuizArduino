# QuizArduino
 
-- Criando o banco de dados
CREATE DATABASE IF NOT EXISTS quiz_arduino;

-- Selecionando o banco de dados
USE quiz_arduino;

-- Tabela para usuários (user)
CREATE TABLE IF NOT EXISTS user (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabela para times (time)
CREATE TABLE IF NOT EXISTS time (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabela para quiz (quiz)
CREATE TABLE IF NOT EXISTS quiz (
    id INT AUTO_INCREMENT PRIMARY KEY,
    pergunta TEXT NOT NULL,
    resposta_correta TEXT NOT NULL,
    data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabela para relatorios (relatorio)
CREATE TABLE IF NOT EXISTS relatorio (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    time_id INT,
    quiz_id INT,
    resposta_user TEXT NOT NULL,
    resultado BOOLEAN,
    data_resposta TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES user(id),
    FOREIGN KEY (time_id) REFERENCES time(id),
    FOREIGN KEY (quiz_id) REFERENCES quiz(id)
);


Explicação das tabelas:
Tabela user: Armazena informações sobre os usuários, como nome, email, senha e a data de cadastro.
Tabela time: Armazena os times, com um nome e a data de criação.
Tabela quiz: Armazena as perguntas e as respostas corretas para o quiz.
Tabela relatorio: Relaciona os usuários com os times e quizzes, registrando as respostas dos usuários, o resultado (se a resposta está certa ou errada) e a data da resposta.


Estrutura de Arquivos:

/quiz_arduino
  ├── /css
  │    └── style.css
  ├── /includes
  │    ├── db.php
  │    └── functions.php
  ├── index.php
  ├── user.php
  ├── time.php
  ├── quiz.php
  ├── relatorio.php
  └── edit_user.php

Explicação:
db.php: Conexão com o banco de dados MySQL.
functions.php: Contém funções para as operações CRUD.
index.php: Exibe a lista de usuários.
user.php: Formulário para cadastrar um novo usuário.
edit_user.php: Formulário para editar um usuário existente.
delete_user.php: Exclui um usuário.
style.css: Estilos básicos para a interface.

############################################

Quiz_arduino 1.2

/quiz_arduino
    /css
        style.css           # Arquivo de estilo CSS
    /includes
        db.php              # Função de conexão com o banco de dados
        functions.php       # Funções CRUD comuns (usuários, quiz, time, relatorio, perguntas_erradas)
    /pages
        index.php           # Página principal
        login.php           # Página de login para alunos e professores
        register.php        # Página de registro para novos usuários
        time.php            # Página para cadastrar e listar times
        quiz.php            # Página para cadastrar e listar quizzes
        relatorio.php       # Página para visualizar relatórios de alunos
        perguntas_erradas.php # Página para listar as perguntas erradas dos alunos
        edit_time.php       # Página para editar time
        edit_quiz.php       # Página para editar quiz
        edit_relatorio.php  # Página para editar relatório
        delete_time.php     # Página para deletar time
        delete_quiz.php     # Página para deletar quiz
        delete_relatorio.php# Página para deletar relatório
        delete_pergunta_errada.php # Página para deletar pergunta errada
    /config
        db.php              # Configuração de conexão com o banco de dados

----------------------------
CREATE DATABASE quiz_arduino;

USE quiz_arduino;

-- Tabela de usuários (professores e alunos)
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    tipo ENUM('professor', 'aluno') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabela de times
CREATE TABLE time (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL
);

-- Tabela de perguntas (quiz)
CREATE TABLE quiz (
    id INT AUTO_INCREMENT PRIMARY KEY,
    pergunta TEXT NOT NULL,
    resposta_correta TEXT NOT NULL,
    resposta_errada1 TEXT NOT NULL,
    resposta_errada2 TEXT NOT NULL,
    resposta_errada3 TEXT NOT NULL
);

-- Tabela de relatorios (respostas dos alunos)
CREATE TABLE relatorio (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    quiz_id INT NOT NULL,
    resposta_usuario TEXT NOT NULL,
    resultado ENUM('correto', 'errado') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES usuarios(id),
    FOREIGN KEY (quiz_id) REFERENCES quiz(id)
);

-- Tabela de perguntas erradas
CREATE TABLE perguntas_erradas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    quiz_id INT NOT NULL,
    resposta_usuario TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES usuarios(id),
    FOREIGN KEY (quiz_id) REFERENCES quiz(id)
);

-- Inserir usuários (professor e aluno)
INSERT INTO usuarios (nome, email, senha, tipo)
VALUES
    ('João Silva', 'joao.silva@example.com', 'senha123', 'professor'),
    ('Maria Oliveira', 'maria.oliveira@example.com', 'senha456', 'professor'),
    ('Carlos Souza', 'carlos.souza@example.com', 'senha789', 'aluno'),
    ('Ana Pereira', 'ana.pereira@example.com', 'senha101', 'aluno');

-- Inserir times
INSERT INTO time (nome)
VALUES
    ('Time Alpha'),
    ('Time Beta'),
    ('Time Gamma');

-- Inserir perguntas para o quiz
INSERT INTO quiz (pergunta, resposta_correta, resposta_errada1, resposta_errada2, resposta_errada3)
VALUES
    ('Qual a capital do Brasil?', 'Brasília', 'Rio de Janeiro', 'São Paulo', 'Brasília do Sul'),
    ('Quem inventou a lâmpada elétrica?', 'Thomas Edison', 'Nikola Tesla', 'Alexander Graham Bell', 'Albert Einstein'),
    ('Qual é o maior planeta do sistema solar?', 'Júpiter', 'Terra', 'Marte', 'Saturno'),
    ('Quem escreveu “Dom Casmurro”?', 'Machado de Assis', 'José de Alencar', 'Monteiro Lobato', 'Clarice Lispector'),
    ('Em que ano o Brasil foi descoberto?', '1500', '1492', '1808', '1922');

-- Inserir relatórios (respostas dos alunos)
INSERT INTO relatorio (user_id, quiz_id, resposta_usuario, resultado)
VALUES
    (3, 1, 'Brasília', 'correto'),
    (4, 1, 'Rio de Janeiro', 'errado'),
    (3, 2, 'Thomas Edison', 'correto'),
    (4, 3, 'Saturno', 'errado'),
    (3, 5, '1500', 'correto');

-- Inserir perguntas erradas (respostas erradas dos alunos)
INSERT INTO perguntas_erradas (user_id, quiz_id, resposta_usuario)
VALUES
    (4, 1, 'Rio de Janeiro'),
    (4, 3, 'Saturno'),
    (4, 4, 'José de Alencar');

