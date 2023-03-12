<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Incidente
 *
 * @ORM\Table(name="incidente", indexes={@ORM\Index(name="IDX_12858081FB0D0145", columns={"id_tipo"}), @ORM\Index(name="IDX_12858081FCF8192D", columns={"id_usuario"})})
 * @ORM\Entity(repositoryClass="App\Repository\IncidenteRepository")
 */
class Incidente
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_incidente", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="incidente_id_incidente_seq", allocationSize=1, initialValue=1)
     */
    private $idIncidente;

    /**
     * @var string
     *
     * @ORM\Column(name="estado", type="string", length=1, nullable=false)
     */
    private $estado;

    /**
     * @var string|null
     *
     * @ORM\Column(name="solucion", type="string", length=250, nullable=true)
     */
    private $solucion;
    /**
     * @var string|null
     *
     * @ORM\Column(name="observacion", type="string", length=250, nullable=true)
     */
    private $observacion;
    /**
     * @var float|null
     *
     * @ORM\Column(name="costo", type="float", nullable=true)
     */
    private $costo;


    /**
     * @var string|null
     *
     * @ORM\Column(name="estado_incidente", type="string", length=100, nullable=true)
     */
    private $estadoIncidente;

    /**
     * @var \Tipoincidente
     *
     * @ORM\ManyToOne(targetEntity="Tipoincidente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_tipo", referencedColumnName="id_tipo")
     * })
     */
    private $idTipo;

    /**
     * @var \Usuario
     *
     * @ORM\ManyToOne(targetEntity="Usuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_usuario", referencedColumnName="id_usuario")
     * })
     */
    private $idUsuario;

    public function getIdIncidente(): ?int
    {
        return $this->idIncidente;
    }

    public function getEstado(): ?string
    {
        return $this->estado;
    }

    public function setEstado(string $estado): self
    {
        $this->estado = $estado;

        return $this;
    }

    public function getSolucion(): ?string
    {
        return $this->solucion;
    }

    public function setSolucion(?string $solucion): self
    {
        $this->solucion = $solucion;

        return $this;
    }
    public function getObservacion(): ?string
    {
        return $this->observacion;
    }

    public function setObservacion(?string $observacion): self
    {
        $this->observacion = $observacion;

        return $this;
    }
    public function getCosto(): ?float
    {
        return $this->costo;
    }

    public function setCosto(float $costo): self
    {
        $this->costo = $costo;

        return $this;
    }

    public function getEstadoIncidente(): ?string
    {
        return $this->estadoIncidente;
    }

    public function setEstadoIncidente(?string $estadoIncidente): self
    {
        $this->estadoIncidente = $estadoIncidente;

        return $this;
    }

    public function getIdTipo(): ?Tipoincidente
    {
        return $this->idTipo;
    }

    public function setIdTipo(?Tipoincidente $idTipo): self
    {
        $this->idTipo = $idTipo;

        return $this;
    }

    public function getIdUsuario(): ?Usuario
    {
        return $this->idUsuario;
    }

    public function setIdUsuario(?Usuario $idUsuario): self
    {
        $this->idUsuario = $idUsuario;

        return $this;
    }


}
