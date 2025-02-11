-- Criação das tabelas
drop database if exists petshop;
create database petshop;
use petshop;

create table Enderecos(
    Id int not null auto_increment primary key,
    Rua varchar(100) not null,
    Numero varchar(100) not null,
    Complemento varchar(100),
    Bairro varchar(100) not null,
    Cidade varchar(100) not null,
    Estado varchar(100) not null,
    CEP varchar(100) not null
);

create table Administradores(
    Id int not null auto_increment primary key,
    CPF varchar(14) not null,
    Senha varchar(30) not null,
    Nome varchar(100) not null,
    Sexo varchar(10) not null,
    DataNasc date not null,
    Telefone varchar(15) not null,
    Email varchar(100) not null,
    DataCadastro date not null
);

create table Secretarios(
    Id int not null auto_increment primary key,
    CPF varchar(14) not null,
    Senha varchar(30) not null,
    Nome varchar(100) not null,
    Sexo varchar(10) not null,
    DataNasc date not null,
    Telefone varchar(15) not null,
    Email varchar(100) not null,
    DataCadastro date not null,
    Administradores_Id int not null,
    foreign key(Administradores_Id) references Administradores(Id)
);

create table Clientes(
    Id int not null auto_increment primary key,
    CPF varchar(14) not null,
    Nome varchar(100) not null,
    Sexo varchar(10) not null,
    DataNasc date not null,
    Telefone varchar(15) not null,
    Email varchar(100) not null,
    DataCadastro date not null,
    Enderecos_Id int not null,
    foreign key(Enderecos_Id) references Enderecos(Id),
    Secretarios_Id int not null,
    foreign key(Secretarios_Id) references Secretarios(Id)
);

create table Promocoes(
    Id int not null auto_increment primary key,
    Nome varchar(100) not null,
    Valor float,
    Administradores_Id int not null,
    foreign key(Administradores_Id) references Administradores(Id)
);

create table Servicos(
    Id int not null auto_increment primary key,
    Nome varchar(100) not null,
    Descricao varchar(1000) not null,
    Valor float not null,
    DuracaoEstimada int,
    Disponibilidade varchar(100),
    Promocoes_Id int not null,
    Administradores_Id int not null,
    foreign key(Promocoes_Id) references Promocoes(Id),
    foreign key(Administradores_Id) references Administradores(Id)
);

create table Animais(
    Id int not null auto_increment primary key,
    Nome varchar(100) not null,
    Tipo varchar(45) not null,
    Raca varchar(45) not null,
    Sexo varchar(5) not null,
    DataNasc date not null,
    DataCadastro date not null,
    Clientes_Id int not null,
    Secretarios_Id int not null,
    foreign key(Clientes_Id) references Clientes(Id),
    foreign key(Secretarios_Id) references Secretarios(Id)
);

create table FormaPagamento(
    Id int not null auto_increment primary key,
    Nome varchar(100) not null,
    Descricao varchar(100) not null
);

create table Compras(
    Id int not null auto_increment primary key,
    DataHora datetime not null,
    Valor float not null,
    Servicos_Id int not null,
    Nome_Servico varchar(100) not null,
    Valor_Servico float,
    Secretarios_Id int not null,
    Nome_Secretario varchar(100) not null,
    Clientes_Id int not null,
    Nome_Cliente varchar(100) not null,
    Animais_Id int not null,
    Nome_Animal varchar(100) not null,
    Promocoes_Id int not null,
    Nome_Promocao varchar(100) not null,
    Valor_Promocao float,
    FormaPagamento_Id int not null,

    foreign key(Servicos_Id) references Servicos(Id),
    foreign key(Secretarios_Id) references Secretarios(Id),
    foreign key(Clientes_Id) references Clientes(Id),
    foreign key(Animais_Id) references Animais(Id),
    foreign key(Promocoes_Id) references Promocoes(Id),
    foreign key(FormaPagamento_Id) references FormaPagamento(Id)
);

-- Inserção de dados nas tabelas
insert into Enderecos (Rua, Numero, Complemento, Bairro, Cidade, Estado, CEP)
values 
('Rua C', '789', 'Apto 102', 'Centro', 'Cidade C', 'São Paulo', '98765-432'),
('Rua D', '1011', '', 'Bairro D', 'Cidade D', 'Rio de Janeiro', '87654-321'),
('Rua E', '1213', 'Casa 1', 'Bairro E', 'Cidade E', 'Minas Gerais', '76543-210'),
('Rua F', '1415', '', 'Bairro F', 'Cidade F', 'Bahia', '65432-109'),
('Rua G', '1617', 'Apto 103', 'Centro', 'Cidade G', 'Pernambuco', '54321-098'),
('Rua H', '1819', 'Casa 2', 'Bairro H', 'Cidade H', 'Amazonas', '43210-987'),
('Rua I', '2021', '', 'Bairro I', 'Cidade I', 'Paraná', '32109-876'),
('Rua J', '2223', 'Casa 3', 'Bairro J', 'Cidade J', 'Ceará', '21098-765'),
('Rua K', '2425', 'Apto 104', 'Centro', 'Cidade K', 'Santa Catarina', '10987-654'),
('Rua L', '2627', '', 'Bairro L', 'Cidade L', 'Rio Grande do Sul', '09876-543'),
('Rua M', '2829', 'Casa 4', 'Bairro M', 'Cidade M', 'Goiás', '98765-432'),
('Rua N', '3031', '', 'Bairro N', 'Cidade N', 'Alagoas', '87654-321'),
('Rua O', '3233', 'Apto 105', 'Centro', 'Cidade O', 'Acre', '76543-210'),
('Rua P', '3435', 'Casa 5', 'Bairro P', 'Cidade P', 'Rondônia', '65432-109'),
('Rua Q', '3637', '', 'Bairro Q', 'Cidade Q', 'Mato Grosso', '54321-098'),
('Rua R', '3839', 'Apto 106', 'Centro', 'Cidade R', 'Tocantins', '43210-987'),
('Rua S', '4041', 'Casa 6', 'Bairro S', 'Cidade S', 'Amapá', '32109-876'),
('Rua T', '4243', '', 'Bairro T', 'Cidade T', 'Paraíba', '21098-765'),
('Rua U', '4445', 'Apto 107', 'Centro', 'Cidade U', 'Sergipe', '10987-654'),
('Rua V', '4647', 'Casa 7', 'Bairro V', 'Cidade V', 'Espírito Santo', '09876-543');

insert into Administradores (CPF, Senha, Nome, Sexo, DataNasc, Telefone, Email, DataCadastro)
values 
('185.689.776-01', 'Mendel72682', 'Maicon Lucas Mendel', 'Masculino', '1990-01-01', '55 92687-9279', 'mendel.hso827@gmail.com', '2024-02-10'); 

insert into Secretarios (CPF, Senha, Nome, Sexo, DataNasc, Telefone, Email, DataCadastro, Administradores_Id)
values 
('871.652.363-84', 'Marcos927282', 'Marcos Flávio de Sousa', 'Masculino', '1995-01-01', '55 92793-9273', 'marcos.926kj@gmail.com', '2024-02-10', 1), 
('652.563.476-45', 'Leila8272', 'Leila Gomes da Silva', 'Feminino', '1996-01-01', '55 97263-8278', 'leila.gomes82638@gmail.com', '2024-02-10', 1), 
('673.874.590-36', 'João92728', 'João Pedro Oliveira', 'Masculino', '1997-01-01', '55 98263-8276', 'joao.jshi82@gmail.com', '2024-02-10', 1), 
('284.435.656-73', 'Raquel.lima726', 'Maria Raquel Lima Martins', 'Feminino', '1998-01-01', '55 98636-9266', 'raquel_8372@gmail.com', '2024-02-10', 1), 
('572.687.237-48', 'André0976', 'André Oliveira Lima', 'Masculino', '1999-01-01', '55 92778-8138', 'andress973@gmai.com', '2024-02-10', 1), 
('634.767.128-59', 'Sara08628', 'Sara Guimarães de Oliveira', 'Feminino', '2000-01-01', '55 91435-0825', 'sara$826@gmail.com', '2024-02-10', 1), 
('257.578.899-30', 'Jorge.hnr', 'Jorge Henrique Oliveira Sousa', 'Masculino', '2001-01-01', '55 94163-9269', 'jorge92638@gmail.com', '2024-02-10', 1), 
('458.978.010-13', 'Sandra0736', 'Sandra Firmina dos Santos', 'Feminino', '2002-01-01', '55 98270-9261', 'sandra.fim8268@gmail.com', '2024-02-10', 1), 
('934.078.651-32', 'Iuri.oli7363', 'Franscisco Iuri Oliveira', 'Masculino', '2003-01-01', '55 95381-0276', 'iuri.oliv8258@gmail.com', '2024-02-10', 1), 
('990.891.452-43', 'Maria82738', 'Maria da Silva', 'Feminino', '2004-01-01', '55 96286-2836', 'maria.sil3@gmail.com', '2024-02-10', 1), 
('151.298.043-47', 'rcr02102006', 'Gabriel Ramos Castro', 'Masculino', '2005-01-01', '55 93684-3483', 'gabriel.castro50@gmail.com', '2024-02-10', 1), 
('262.823.654-53', 'Brunaa.7796', 'Bruna Sabino de Oliveira', 'Feminino', '2006-01-01', '55 98264-4837', 'bruna.sa7878@gmail.com', '2024-02-10', 1), 
('357.426.345-56', 'Wevelin22', 'João Nycolas Mulato Maciel', 'Masculino', '2007-01-01', '55 91635-5827', 'mulatin.cria873@gmail.com', '2024-02-10', 1), 
('724.235.246-47', 'Gabriela8278', 'Gabriela Priscila lima', 'Feminino', '2008-01-01', '55 91536-9377', 'gabriela.lima8272@gmail.com', '2024-02-10', 1), 
('175.926.027-89', 'Vinicius0202', 'Vinicíus Hudson Maicon', 'Masculino', '2009-01-01', '55 97267-7827', 'vinicius.hudson8623@gmail.com', '2024-02-10', 1), 
('628.729.728-49', 'Rogeria8268', 'Rogeria Sabino Bruna Costa ', 'Feminino', '2010-01-01', '55 97364-9268', 'rogeria.roger8279@gmail.com', '2024-02-10', 1), 
('827.138.189-90', 'Melquiseque', 'Melquiseque Andrade Ferreira', 'Masculino', '2011-01-01', '55 97264-8268', 'melquiseque.cos873@gmail.com', '2024-02-10', 1), 
('173.822.098-11', 'GRC', 'Nicole Lima Ramos', 'Feminino', '2012-01-01', '55 99270-6151', 'lima.castrin979@gmail.com', '2024-02-10', 1), 
('902.820.621-21', 'Erik7892', 'Franscisco Erik Roseno', 'Masculino', '2013-01-01', '55 96251-8273', 'erik.trufaninhomorango726@gmail.com', '2024-02-10', 1), 
('027.161.922-34', 'Edilenee86', 'Edilene Oliveira Lima', 'Feminino', '2014-01-01', '55 97253-2927', 'edilene.oli736@gmail.com', '2024-02-10', 1); 

insert into Clientes (CPF, Nome, Sexo, DataNasc, Telefone, Email, DataCadastro, Enderecos_Id, Secretarios_Id)
values 
('927.627.651-01', 'Matheus da Silva Pereira', 'Masculino', '1992-01-01', '55 96258-1827', 'matheus_dasilva63@gmail.com', '2024-02-10', 1, 1), 
('826.544.290-12', 'Magna de Oliveira Silva', 'Feminino', '1993-01-01', '55 92732-2937', 'magna$0909@gmal.com', '2024-02-10', 2, 2), 
('762.482.102-23', 'Vladimir Predeiro Matador', 'Masculino', '1994-01-01', '55 97293-9073', 'vladimir.peiaracismo@gmail.com', '2024-02-10', 3, 3), 
('665.356.076-34', ' Maria Socorro Ferreira', 'Feminino', '1995-01-01', '55 97250-7644', 'socorrosos@gmail.com', '2024-02-10', 4, 4), 
('562.760.997-45', 'Isaac chaves Cavalieri', 'Masculino', '1996-01-01', '55 92555-7265', 'isaac.1e3.2e5@gmail.com', '2024-02-10', 5, 5), 
('872.189.875-56', 'Flaviana Gomes Soares', 'Feminino', '1997-01-01', '55 97256-0920', 'flaviana$87993@gmail.com', '2024-02-10', 6, 6), 
('362.083.792-67', 'Pedro Carlos Alberto', 'Masculino', '1998-01-01', '55 91527-0287', 'pedro.carlos872@gmail.com', '2024-02-10', 7, 7), 
('272.956.667-78', 'Flávia Soares de Melo', 'Feminino', '1999-01-01', '55 91520-9138', 'flaviamelo6473@gmail.com', '2024-02-10', 8, 8), 
('249.888.563-89', 'Jadeison Carlos de Lima', 'Masculino', '2000-01-01', '55 98169-1038', 'jadeisonconstru8262@gmail.com', '2024-02-10', 9, 9), 
('068.885.652-90', 'Daniela Martins de Souza', 'Feminino', '2001-01-01', '55 91730-0260', 'danielaoficial2868@gmail.com', '2024-02-10', 10, 10), 
('897.764.881-01', 'Cleber Antônio de Melo', 'Masculino', '2002-01-01', '55 96271-7360', 'cleberprofissional759@gmail.com', '2024-02-10', 11, 11), 
('826.923.920-12', 'Jéssica Pinto Costa', 'Feminino', '2003-01-01', '55 91037-1038', 'jessicapinto8268@gmail.com', '2024-02-10', 12, 12), 
('782.482.119-23', 'Fábio Henrique Oliveira', 'Masculino', '2004-01-01', '55 91730-8263', 'fabio.hrq135@gmail.com', '2024-02-10', 13, 13), 
('914.911.718-34', 'Sheila Yamamoto Covideres', 'Feminino', '2005-01-01', '55 96153-0174', 'sheisss7692@gmail.com', '2024-02-10', 14, 14), 
('913.810.827-45', 'Calvo Ferreira Maia', 'Masculino', '2006-01-01', '55 82635-0263', 'calvo.oipessoall@gmail.com', '2024-02-10', 15, 15), 
('872.179.876-56', 'Georgina Iphyfanio Melo', 'Feminino', '2007-01-01', '55 91036-7266', 'georgina.prof768@gmail.com', '2024-02-10', 16, 16), 
('386.728.755-67', 'Jean Gleidson Cavalcante', 'Masculino', '2008-01-01', '55 91538-9237', 'jeanquimico8628@gmail.com', '2024-02-10', 17, 17), 
('286.177.884-78', 'Yasmin da Costa Melo', 'Feminino', '2009-01-01', '55 91592-8163', 'yasmin.costa8267@gmail.com', '2024-02-10', 18, 18), 
('117.838.783-89', 'Antônio Fábio Checklist', 'Masculino', '2010-01-01', '55 92638-8279', 'checklist7686@gmail.com', '2024-02-10', 19, 19), 
('086.765.862-90', 'Paula Costa Melo', 'Feminino', '2011-01-01', '55 92630-9790', 'Paulamelo96@gmail.com', '2024-02-10', 20, 20); 

insert into Promocoes (Nome, Valor, Administradores_Id)
values 
('Sem promoção', 0.00, 1),
('Outono', 9.99, 1),
('Inverno', 14.99, 1),
('Primavera', 19.99, 1),
('Verão', 24.99, 1),
('Aniversário', 29.99, 1),
('Black Friday', 19.99, 1),
('Dia dos Namorados', 14.99, 1),
('Carnaval+', 24.99, 1),
('Volta às Aulas', 19.99, 1),
('Festa Junina', 19.99, 1),
('Natal', 24.99, 1),
('Ano Novo', 19.99, 1),
('Páscoa', 14.99, 1),
('Halloween', 9.99, 1),
('Dia das Mães', 24.99, 1),
('Dia dos Pais', 19.99, 1),
('Volta às Aulas+', 14.99, 1),
('Carnaval', 9.99, 1),
('Black Friday+', 24.99, 1),
('Dia das Crianças', 19.99, 1);

insert into Servicos (Nome, Descricao, Valor, DuracaoEstimada, Disponibilidade, Promocoes_Id, Administradores_Id)
values 
('Banho', 'Banho com shampoo neutro e secagem rápida', 20.01, 20, 'Segunda a sábado, das 9h às 17h', 1, 1),
('Banho+', 'Banho com shampoo especial relaxante e massagem durante a secagem', 50.01, 30, 'Segunda a sábado, das 9h às 17h', 2, 1),
('Tosa', 'Tosa para higiene, incluindo tosa das partes íntimas e corte de unhas', 45.01, 25, 'Segunda a sábado, das 9h às 17h', 3, 1),
('Tosa+', 'Tosa criativa com diferentes estilos e acabamentos', 55.01, 40, 'Segunda a sábado, das 9h às 17h', 4, 1),
('Petcure', 'Corte seguro das unhas do pet para evitar desconforto e lesões', 25.01, 15, 'Segunda a sábado, das 9h às 17h', 5, 1),
('Otorrino', 'Limpeza suave e segura dos ouvidos para prevenir infecções', 20.01, 10, 'Segunda a sábado, das 9h às 17h', 6, 1),
('Massagem', 'Massagem terapêutica para relaxar os músculos e aliviar o estresse', 35.01, 30, 'Segunda a sábado, das 9h às 17h', 7, 1),
('Adestramento', 'Aulas individuais para ensinar comandos básicos e comportamento adequado', 70.01, 60, 'Segunda a sexta, das 9h às 17h', 8, 1),
('Atendimento Domiciliar', 'Consulta veterinária no conforto do lar do cliente', 90.01, 45, 'Segunda a sexta, das 9h às 17h', 9, 1),
('Sessão de Fotos (1 hora)', 'Sessão profissional de fotos para capturar momentos especiais', 55.01, 60, 'Segunda a domingo, com agendamento prévio', 11, 1),
('Pet Hotel', 'Hospedagem de luxo para pets, com quartos individuais, camas confortáveis e atividades recreativas.', 250.01, 24, 'Segunda a domingo, 24 horas', 12, 1),
('Daycare', 'Creche para pets, oferecendo cuidados durante o dia, incluindo atividades supervisionadas e área para brincadeiras.', 50.01, 8, 'Segunda a sexta, das 8h às 18h', 13, 1),
('Castração', 'Procedimento cirúrgico para esterilização de pets, incluindo castração de cães e gatos.', 200.01, 120, 'Segunda a sexta, das 9h às 17h', 14, 1),
('Emergência', 'Procedimento cirúrgico de emergência para pets, incluindo tratamento de ferimentos graves e condições médicas urgentes.', 500.01, 180, 'Segunda a domingo, 24 horas', 15, 1),
('Ortopedia', 'Procedimento cirúrgico para correção de problemas ortopédicos em pets, como fraturas e lesões articulares.', 100.01, 180, 'Segunda a sexta, das 9h às 17h', 16, 1),
('Correção Bucal', 'Procedimento cirúrgico para tratamento de problemas dentários em pets, incluindo extração de dentes, tratamento de gengivite e outras condições odontológicas.', 150.01, 90, 'Segunda a sexta, das 9h às 17h', 17, 1),
('Remoção de Tecidos', 'Procedimento cirúrgico para correção de problemas de tecidos moles em pets, incluindo remoção de tumores, tratamento de abscessos e outras condições relacionadas a tecidos moles.', 150.01, 120, 'Segunda a sexta, das 9h às 17h', 18, 1);

insert into FormaPagamento (Nome, Descricao)
values 
('Cartão de Crédito', 'Pagamento realizado através de cartão de crédito'),
('Dinheiro', 'Pagamento realizado em dinheiro'),
('Pix', 'Pagamento realizado através do Pix');

insert into Animais (Nome, Tipo, Raca, Sexo, DataNasc, DataCadastro, Clientes_Id, Secretarios_Id)
values
('Toby', 'Gato', 'Siamês', 'Macho', '2019-09-05', '2024-03-03', 1, 1),
('Luna', 'Cachorro', 'Labrador', 'Fêmea', '2020-01-20', '2024-03-10', 2, 2),
('Buddy', 'Cachorro', 'Golden Retriever', 'Macho', '2018-06-15', '2024-03-15', 3, 1),
('Lucy', 'Gato', 'Persa', 'Fêmea', '2019-03-10', '2024-03-20', 4, 2),
('Max', 'Cachorro', 'Bulldog Francês', 'Macho', '2021-02-28', '2024-04-01', 5, 1),
('Bella', 'Cachorro', 'Poodle', 'Fêmea', '2017-08-10', '2024-04-05', 6, 2),
('Charlie', 'Gato', 'Maine Coon', 'Macho', '2018-12-15', '2024-04-10', 7, 1),
('Daisy', 'Cachorro', 'Shih Tzu', 'Fêmea', '2020-07-20', '2024-04-15', 8, 2),
('Rocky', 'Cachorro', 'Rottweiler', 'Macho', '2019-05-10', '2024-04-20', 9, 1),
('Molly', 'Gato', 'Siamese', 'Fêmea', '2020-04-01', '2024-05-01', 10, 2),
('Bailey', 'Cachorro', 'Beagle', 'Macho', '2018-09-18', '2024-05-05', 11, 1),
('Sadie', 'Cachorro', 'Dachshund', 'Fêmea', '2017-10-30', '2024-05-10', 12, 2),
('Cooper', 'Gato', 'British Shorthair', 'Macho', '2019-08-10', '2024-05-15', 13, 1),
('Zoey', 'Cachorro', 'Yorkshire Terrier', 'Fêmea', '2021-01-02', '2024-05-20', 14, 2),
('Milo', 'Cachorro', 'Maltese', 'Macho', '2018-11-25', '2024-06-01', 15, 1),
('Lola', 'Gato', 'Ragdoll', 'Fêmea', '2019-07-05', '2024-06-05', 16, 2),
('Harley', 'Cachorro', 'Boxer', 'Macho', '2020-03-12', '2024-06-10', 17, 1),
('Ruby', 'Cachorro', 'Chihuahua', 'Fêmea', '2018-04-20', '2024-06-15', 18, 2),
('Oscar', 'Gato', 'Persa', 'Macho', '2017-06-28', '2024-06-20', 19, 1),
('Mia', 'Cachorro', 'Dalmatian', 'Fêmea', '2019-10-15', '2024-06-25', 20, 2);

insert into Compras (DataHora, Valor, Servicos_Id, Nome_Servico, Valor_Servico, Secretarios_Id, Nome_Secretario, Clientes_Id, Nome_Cliente, Animais_Id, Nome_Animal, Promocoes_Id, Nome_Promocao, Valor_Promocao, FormaPagamento_Id)
values 
('2024-07-11 09:00:00', 20.01, 1, 'Banho', 20.01, 3, 'João Pedro Oliveira', 1, 'Matheus da Silva Pereira', 1, 'Toby', 1, 'Sem promoção', 0.00, 1), 
('2024-07-12 10:15:00', 50.01, 2, 'Banho+', 50.01, 4, 'Maria Raquel Lima Martins', 2, 'Magna de Oliveira Silva', 2, 'Luna', 2, 'Outono', 9.99, 2), 
('2024-07-13 11:30:00', 45.01, 3, 'Tosa', 45.01, 5, 'André Oliveira Lima', 3, 'Vladimir Predeiro Matador', 3, 'Buddy', 1, 'Sem promoção', 0.00, 3), 
('2024-07-14 13:45:00', 200.01, 13, 'Castração', 200.01, 6, 'Sara Guimarães de Oliveira', 4, 'Maria Socorro Ferreira', 4, 'Lucy', 3, 'Inverno', 14.99, 2), 
('2024-07-15 15:00:00', 100.01, 15, 'Ortopedia', 100.01, 7, 'Jorge Henrique Oliveira Sousa', 5, 'Isaac Chaves Cavalieri', 5, 'Max', 5, 'Verão', 19.99, 1), 
('2024-07-16 09:30:00', 150.01, 16, 'Correção bucal', 150.01, 8, 'Sandra Firmina dos Santos', 6, 'Flaviana Gomes Soares', 6, 'Bella', 1, 'Sem promoção', 0.00, 3), 
('2024-07-17 11:45:00', 150.01, 17, 'Remoção de Tecidos', 150.01, 9, 'Franscisco Iuri Oliveira', 7, 'Pedro Carlos Alberto', 7, 'Charlie', 5, 'Verão', 19.99, 3), 
('2024-07-18 14:00:00', 70.01, 8, 'Adestramento', 70.01, 10, 'Maria da Silva', 8, 'Flávia Soares de Melo', 8, 'Daisy', 1, 'Não tem promoção', 0.00, 2), 
('2024-07-19 10:00:00', 90.01, 9, 'Atendimento Domiciliar', 90.01, 11, 'Gabriel Ramos Castro', 9, 'Jadeison Carlos de Lima', 9, 'Rocky', 5, 'Verão', 19.99, 1), 
('2024-07-20 12:15:00', 50.01, 12, 'Daycare', 50.01, 12, 'Bruna Sabino de Oliveira', 10, 'Daniela Martins de Souza', 10, 'Molly', 3, 'Inverno', 14.99, 2), 
('2024-07-21 14:30:00', 250.01, 11, 'Pet Hotel', 250.01, 13, 'João Nycolas Mulato Maciel', 11, 'Cleber Antônio de Melo', 11, 'Bailey', 1, 'Sem promoção', 0.00, 1), 
('2024-07-22 09:45:00', 55.01, 10, 'Sessão de Fotos (1 hora)', 55.01, 14, 'Gabriela Priscila Lima', 12, 'Jéssica Pinto Costa', 12, 'Sadie', 5, 'Verão', 19.99, 2), 
('2024-07-23 11:00:00', 35.01, 7, 'Massagem', 35.01, 15, 'Vinicíus Hudson Maicon', 13, 'Fábio Henrique Oliveira', 13, 'Cooper', 1, 'Sem promoção', 0.00, 1), 
('2024-07-24 13:20:00', 20.01, 6, 'Otorrino', 20.01, 16, 'Rogeria Sabino Bruna Costa', 14, 'Sheila Yamamoto Covideres', 14, 'Zoey', 3, 'Inverno', 14.99, 2), 
('2024-07-25 15:45:00', 70.01, 8, 'Adestramento', 70.01, 17, 'Melquiseque Andrade Ferreira', 15, 'Calvo Ferreira Maia', 15, 'Milo', 5, 'Verão', 19.99, 3), 
('2024-07-26 10:30:00', 25.01, 5, 'Petcure', 25.01, 18, 'Nicole Lima Ramos', 16, 'Georgina Iphyfanio Melo', 16, 'Lola', 1, 'Sem promoção', 0.00, 2), 
('2024-07-27 12:40:00', 55.01, 4, 'Tosa+', 55.01, 19, 'Franscisco Erik Roseno', 17, 'Jean Gleidson Cavalcante', 17, 'Harley', 5, 'Verão', 19.99, 1), 
('2024-07-29 09:20:00', 500.01, 14, 'Emergência', 500.01, 1, 'Marcos Flávio de Sousa', 18, 'Yasmin da Costa Melo', 18, 'Ruby', 3, 'Inverno', 14.99, 1);
