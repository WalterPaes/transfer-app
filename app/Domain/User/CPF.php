<?php

namespace App\Domain\User;

use App\Domain\User\Exception\InvalidCPFException;

/**
 * Class CPF
 * @package App\Domain\User
 */
class CPF
{
    /**
     * @var string
     */
    private string $cpf;

    /**
     * CPF constructor.
     * @param string $cpf
     */
    public function __construct(string $cpf)
    {
        $cpf = preg_replace('/[^0-9]/is', '', $cpf);
        if (!$this->validate($cpf)) {
            throw new InvalidCPFException($cpf);
        }
        $this->cpf = $cpf;
    }

    /**
     * CPF's validation method
     * Source Code: https://gist.github.com/rafael-neri/ab3e58803a08cb4def059fce4e3c0e40
     * @param string $cpf
     * @return bool
     */
    public function validate(string $cpf): bool
    {
        if (strlen($cpf) != 11) {
            return false;
        }

        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }

        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }
        return true;
    }

    public function __toString(): string
    {
        return $this->cpf;
    }
}
