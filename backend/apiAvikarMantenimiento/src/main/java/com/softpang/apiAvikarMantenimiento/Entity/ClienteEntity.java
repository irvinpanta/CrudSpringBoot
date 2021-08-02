package com.softpang.apiAvikarMantenimiento.Entity;

import javax.persistence.Column;
import javax.persistence.Entity;
import javax.persistence.PrimaryKeyJoinColumn;
import javax.persistence.Table;

@Entity
@Table(name = "clientes")
@PrimaryKeyJoinColumn(name = "cliente_person")
public class ClienteEntity extends PersonaEntity{

    @Column(length = 1)
    private Integer defecto;

    public ClienteEntity() {
    }

    public Integer getDefecto() {
        return defecto;
    }

    public void setDefecto(Integer defecto) {
        this.defecto = defecto;
    }
}
