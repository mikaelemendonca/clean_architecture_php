<?php

namespace Alura\Arquitetura\Tests\Aplicacao\Aluno;

use Alura\Arquitetura\Dominio\Cpf;
use Alura\Arquitetura\Dominio\Aluno\AlunoComDoisTelefones;
use Alura\Arquitetura\Aplicacao\Aluno\MatricularAluno\MatricularAluno;
use Alura\Arquitetura\Aplicacao\Aluno\MatricularAluno\MatricularAlunoDto;
use Alura\Arquitetura\Infra\RepositorioAlunosEmMemoria;
use PHPUnit\Framework\TestCase;

class MatricularAlunoTest extends TestCase
{
    public function testAlunoDeveSerAdicionadoAoRepositorio()
    {
        $dadosAluno = new MatricularAlunoDto(
            '123.456.789-10',
            'Teste',
            'email@email.com'
        );

        $repoAluno = new RepositorioAlunosEmMemoria();
        $useCase = new MatricularAluno($repoAluno);
        $useCase->executa($dadosAluno);

        $aluno = $repoAluno->buscarPorCpf(new Cpf('123.456.789-10'));
        $this->assertSame('Teste', (string) $aluno->nome());
        $this->assertSame('email@email.com', (string) $aluno->email());
        $this->assertEmpty($aluno->telefones());
    }
}
