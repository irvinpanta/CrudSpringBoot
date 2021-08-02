package com.softpang.apiAvikarMantenimiento.Entity;


import javax.persistence.*;

@Entity
@Table(name = "empleado")
@PrimaryKeyJoinColumn(name = "empleado_persona")
public class EmpleadoEntity extends PersonaEntity{

    @Column(length = 15)
    private String usuario;
    private String password;
    @ManyToOne
    @JoinColumn(name = "rol")
    private RolEntity rol;

    public EmpleadoEntity() {
    }

    @PrePersist
    public void insertDefault() {
        this.usuario = getUsuario();
        this.password = "123456";
    }

    public String getUsuario() {
        return usuario;
    }

    public void setUsuario(String usuario) {
        this.usuario = usuario;
    }

    public RolEntity getRol() {
        return rol;
    }

    public void setRol(RolEntity rol) {
        this.rol = rol;
    }
}
