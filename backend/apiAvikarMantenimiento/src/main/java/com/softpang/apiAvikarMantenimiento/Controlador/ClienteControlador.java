package com.softpang.apiAvikarMantenimiento.Controlador;

import com.softpang.apiAvikarMantenimiento.Entity.ClienteEntity;
import com.softpang.apiAvikarMantenimiento.Servicio.ClienteServicio;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import java.util.ArrayList;

@RestController
@RequestMapping("/api/cliente")
@CrossOrigin
public class ClienteControlador {

    @Autowired
    private ClienteServicio clienteSer;

    @GetMapping("/listar")
    public ResponseEntity<ArrayList<ClienteEntity>> listarAll(){
        ArrayList<ClienteEntity> lista = clienteSer.listarAll();
        return new ResponseEntity(lista, HttpStatus.OK);
    }

    @GetMapping("/listar/{id}")
    public ResponseEntity<ClienteEntity> buscarPorId(@PathVariable("id") int id){
        if (!clienteSer.existsById(id))
            return new ResponseEntity("MSG_0006", HttpStatus.NOT_FOUND);
        ClienteEntity resul = clienteSer.buscarPorId(id).get();
        return new ResponseEntity(resul, HttpStatus.OK);
    }

    @PostMapping("/save")
    public ResponseEntity<?> save(@RequestBody ClienteEntity cliente){
        if(clienteSer.existsByDni(cliente.getNumerodocumento()))
            return new ResponseEntity("MSG_0005", HttpStatus.BAD_REQUEST);
        if((cliente.getNumerodocumento() == "") || (cliente.getNombres() == "") || (cliente.getApellidos() == "") || (cliente.getDireccion() == ""))
            return new ResponseEntity("", HttpStatus.BAD_REQUEST);

        clienteSer.mantenimientoData(cliente);
        return new ResponseEntity("MSG_0001", HttpStatus.OK);
    }

    @PutMapping("/update/{id}")
    public ResponseEntity<?> update(@PathVariable("id")int id, @RequestBody ClienteEntity cliente){
        if(!clienteSer.existsById(id))
            return new ResponseEntity("MSG_0006", HttpStatus.NOT_FOUND);
        if((cliente.getNumerodocumento() == "") || (cliente.getNombres() == "") || (cliente.getApellidos() == "") || (cliente.getDireccion() == ""))
            return new ResponseEntity("MSG_0040", HttpStatus.BAD_REQUEST);
        if(clienteSer.existsByDni(cliente.getNumerodocumento()) && clienteSer.buscarPorDni(cliente.getNumerodocumento()).get().getPersona() != id)
            return new ResponseEntity("MSG_0005", HttpStatus.BAD_REQUEST);

        ClienteEntity entity = clienteSer.buscarPorId(id).get();
        entity.setNumerodocumento(cliente.getNumerodocumento());
        entity.setNombres(cliente.getNombres());
        entity.setApellidos(cliente.getApellidos());
        entity.setDireccion(cliente.getDireccion());
        entity.setTelefono(cliente.getTelefono());
        entity.setActivo(cliente.getActivo());
        entity.setDefecto(cliente.getDefecto());
        clienteSer.mantenimientoData(entity);
        return new ResponseEntity("MSG_0002", HttpStatus.OK);
    }

    @DeleteMapping("/delete/{id}")
    public ResponseEntity<?> delete(@PathVariable("id")int id){
        if(!clienteSer.existsById(id))
            return new ResponseEntity("MSG_0006", HttpStatus.NOT_FOUND);
        clienteSer.delete(id);
        return new ResponseEntity("MSG_0003", HttpStatus.OK);
    }
}
