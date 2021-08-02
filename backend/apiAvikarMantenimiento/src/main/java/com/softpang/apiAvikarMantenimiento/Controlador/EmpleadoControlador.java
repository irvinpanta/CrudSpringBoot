package com.softpang.apiAvikarMantenimiento.Controlador;

import com.softpang.apiAvikarMantenimiento.Entity.EmpleadoEntity;
import com.softpang.apiAvikarMantenimiento.Servicio.EmpleadoServicio;
import com.softpang.apiAvikarMantenimiento.Servicio.RolServicio;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import java.util.ArrayList;

@RestController
@RequestMapping("/api/empleado")
@CrossOrigin
public class EmpleadoControlador {

    @Autowired
    private EmpleadoServicio empleadoSer;

    @Autowired
    private RolServicio rolSer;

    @GetMapping("/listar")
    public ResponseEntity<ArrayList<EmpleadoEntity>> listarAll(){
        ArrayList<EmpleadoEntity> lista = empleadoSer.listarAll();
        return ResponseEntity.ok(lista);
    }

    @GetMapping("/listar/{id}")
    public ResponseEntity<EmpleadoEntity> buscarPorId(@PathVariable("id") int id){
        if(!empleadoSer.existsById(id))
            return new ResponseEntity("MSG_0006", HttpStatus.NOT_FOUND);

        EmpleadoEntity resul = empleadoSer.buscarPorId(id).get();
        return new ResponseEntity(resul, HttpStatus.OK);
    }

    @PostMapping("/save")
    public ResponseEntity<?> save(@RequestBody EmpleadoEntity empleado){

        if (empleadoSer.existsByDni(empleado.getNumerodocumento()))
            return new ResponseEntity("MSG_0005", HttpStatus.BAD_REQUEST);
        if(empleado.getNumerodocumento() == "" || empleado.getNombres() == "")
            return new ResponseEntity("MSG_0040", HttpStatus.BAD_REQUEST);
        if(empleado.getApellidos() == "" || empleado.getDireccion() == "")
            return new ResponseEntity("MSG_0040", HttpStatus.BAD_REQUEST);
        if(!rolSer.existePorId(empleado.getRol().getRol()))
            return new ResponseEntity("MSG_0006", HttpStatus.BAD_REQUEST);

        empleado.setUsuario(empleado.getNumerodocumento());
        empleadoSer.mantenimientoData(empleado);
        return new ResponseEntity("MSG_0001", HttpStatus.OK);
    }

    @PutMapping("/update/{id}")
    public ResponseEntity<?> update(@PathVariable("id") int id, @RequestBody EmpleadoEntity empleado){
        if (!empleadoSer.existsById(id))
            return new ResponseEntity("MSG_0006", HttpStatus.NOT_FOUND);
        if(empleado.getNumerodocumento() == "" || empleado.getNombres() == "")
            return new ResponseEntity("MSG_0040", HttpStatus.BAD_REQUEST);
        if(empleado.getApellidos() == "" || empleado.getDireccion() == "")
            return new ResponseEntity("MSG_0040", HttpStatus.BAD_REQUEST);
        if(!rolSer.existePorId(empleado.getRol().getRol()))
            return new ResponseEntity("MSG_0006", HttpStatus.NOT_FOUND);
        if(empleadoSer.existsByDni(empleado.getNumerodocumento()) && empleadoSer.buscarPorNumeroDocumento(empleado.getNumerodocumento()).get().getPersona() != id)
            return new ResponseEntity("MSG_0005", HttpStatus.BAD_REQUEST);

        EmpleadoEntity entity = empleadoSer.buscarPorId(id).get();
        entity.setNumerodocumento(empleado.getNumerodocumento());
        entity.setNombres(empleado.getNombres());
        entity.setApellidos(empleado.getApellidos());
        entity.setDireccion(empleado.getDireccion());
        entity.setTelefono(empleado.getTelefono());
        entity.setActivo(empleado.getActivo());
        entity.setRol(empleado.getRol());
        empleadoSer.mantenimientoData(entity);
        return new ResponseEntity("MSG_0002", HttpStatus.OK);
    }

    @DeleteMapping("/delete/{id}")
    public ResponseEntity<?> delete(@PathVariable("id") int id){
        try {
            if(!empleadoSer.existsById(id))
                return new ResponseEntity("MSG_0006", HttpStatus.NOT_FOUND);

            empleadoSer.delete(id);
            return new ResponseEntity("MSG_0003", HttpStatus.OK);
        }catch (Exception ex){
            return new ResponseEntity("MSG_0030", HttpStatus.CONFLICT);
        }

    }
}
