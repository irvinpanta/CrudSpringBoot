package com.softpang.apiAvikarMantenimiento.Entity;


import lombok.Data;

import javax.persistence.*;

@Entity
@Table(name = "empleado")
@PrimaryKeyJoinColumn(name = "empleado_persona")
@Data
public class EmpleadoEntity extends PersonaEntity{

    @Column(length = 15)
    private String usuario;
    private String password;
    private Integer rol;

    @PrePersist
    public void insertDefault() {
        this.usuario = getUsuario();
        this.password = "123456";
    }

}
