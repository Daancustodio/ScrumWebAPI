INSERT INTO `bancoscrum`.`usuario`
(
`email`,
`senha`,
`nome`,
`foto`,
`dataCriacao`,
`dataExclusao`,
`foiExcluido`)
VALUES
(
'srdaniiel@gmail.com',
'1',
'Daniel',
'',
now(),
null,
false);

INSERT INTO `bancoscrum`.`usuario`
(`email`,
`senha`,
`nome`,
`foto`,
`dataCriacao`,
`dataExclusao`,
`foiExcluido`)
VALUES
(
'carlos@gmail.com',
'1',
'Carlos Lúcio',
'',
now(),
null,
false);

INSERT INTO `bancoscrum`.`usuario`
(
`email`,
`senha`,
`nome`,
`foto`,
`dataCriacao`,
`dataExclusao`,
`foiExcluido`)
VALUES
(
'fabio@gmail.com',
'1',
'Fabio Campos',
'',
now(),
null,
false);

INSERT INTO `bancoscrum`.`usuario`
(
`email`,
`senha`,
`nome`,
`foto`,
`dataCriacao`,
`dataExclusao`,
`foiExcluido`)
VALUES
(
'raphael@gmail.com',
'1',
'Raphael ',
'',
now(),
null,
false);

INSERT INTO `bancoscrum`.`usuario`
(
`email`,
`senha`,
`nome`,
`foto`,
`dataCriacao`,
`dataExclusao`,
`foiExcluido`)
VALUES
(
'Andre@gmail.com',
'1',
'Andre NOEL',
'',
now(),
null,
false);

INSERT INTO `bancoscrum`.`papel`
(
`descricao`,
`dataCriacao`,
`dataExclusao`,
`foiExcluido`,
`id_usuario`)
VALUES
(
'Programador',
now(),
null,
false,
null);

INSERT INTO `bancoscrum`.`papel`
(
`descricao`,
`dataCriacao`,
`dataExclusao`,
`foiExcluido`,
`id_usuario`)
VALUES
(
'Analista de Teste',
now(),
null,
false,
null);

INSERT INTO `bancoscrum`.`papel`
(
`descricao`,
`dataCriacao`,
`dataExclusao`,
`foiExcluido`,
`id_usuario`)
VALUES
(
'Analista de Requisitos',
now(),
null,
false,
null);

INSERT INTO `bancoscrum`.`papel`
(
`descricao`,
`dataCriacao`,
`dataExclusao`,
`foiExcluido`,
`id_usuario`)
VALUES
(
'Projetista',
now(),
null,
false,
null);


INSERT INTO `bancoscrum`.`time`
(
`descricao`,
`dataCriacao`,
`dataExclusao`,
`foiExcluido`,
`id_usuario`)
VALUES
(
'Alfa',
now(),
null,
false,
1);

INSERT INTO `bancoscrum`.`tipotarefa` ( `descricao`, `dataCriacao`, `dataExclusao`, `foiExcluido`, `id_usuario`) VALUES ( 'Requisito', now(), null, false, null);
INSERT INTO `bancoscrum`.`tipotarefa` ( `descricao`, `dataCriacao`, `dataExclusao`, `foiExcluido`, `id_usuario`) VALUES ( 'Implementação', now(), null, false, null);

INSERT INTO `bancoscrum`.`tipotarefa` ( `descricao`, `dataCriacao`, `dataExclusao`, `foiExcluido`, `id_usuario`) VALUES ( 'Testes Funcionais', now(), null, false, null);

INSERT INTO `bancoscrum`.`tipotarefa` ( `descricao`, `dataCriacao`, `dataExclusao`, `foiExcluido`, `id_usuario`) VALUES ( 'Retrabalho', now(), null, false, null);

INSERT INTO `bancoscrum`.`tipotarefa` ( `descricao`, `dataCriacao`, `dataExclusao`, `foiExcluido`, `id_usuario`) VALUES ( 'Testes Exploratórios', now(), null, false, null);

INSERT INTO `bancoscrum`.`tipotarefa` ( `descricao`, `dataCriacao`, `dataExclusao`, `foiExcluido`, `id_usuario`) VALUES ( 'Preparação de Ambiente', now(), null, false, null);




INSERT INTO `bancoscrum`.`projeto`
(
`titulo`,
`descricao`,
`dataCriacao`,
`dataExclusao`,
`foiExcluido`,
`id_usuario`)
VALUES
('Projeto 1',
'Descrição',
now(),
null,
false,
1);



INSERT INTO `bancoscrum`.`sprint`
(`titulo`,
`descricao`,
`diasUteis`,
`diasCerimonias`,
`horasTrabDia`,
`foco`,
`dataInicio`,
`dataConclusao`,
`status`,
`dataCriacao`,
`dataExclusao`,
`foiExcluido`,
`id_projeto`)
VALUES
('Sprint de Teste',
'Descrição da Sprint',
25,
null,
'7:00',
80,
now(),
date_Add(now() , interval 25 day),
1,
now(),
null,
false,
1);


