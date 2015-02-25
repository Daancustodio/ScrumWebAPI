INSERT INTO `bancoscrum`.`sprint`
(
`titulo`,
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
(
'Sprint eSocial',
'1.Modificar o cadastro da ocorrência de rescisão do módulo FPw Cadastros e Cálculos adicionando os novos campos e comportamentos necessários para atendimento da emissão do leiaute S-2800 do eSocial, tratando todas as funcionalidades impactadas no FPW, FPWeb e IVS.',
15,
2,
8,
70,
now(),
date_add(now(), INTERVAL 15 day) ,
1,
now(),
null,
false,
1);
SELECT * FROM bancoscrum.sprint;