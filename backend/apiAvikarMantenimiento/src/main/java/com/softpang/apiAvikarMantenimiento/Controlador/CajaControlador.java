package com.softpang.apiAvikarMantenimiento.Controlador;

import com.softpang.apiAvikarMantenimiento.Entity.CajaEntity;
import com.softpang.apiAvikarMantenimiento.Modelo.CajaModelDto;
import com.softpang.apiAvikarMantenimiento.Servicio.CajaServicio;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import java.util.ArrayList;
import java.util.Optional;

@RestController
@RequestMapping("/api/caja")
@CrossOrigin
public class CajaControlador {

    @Autowired
    private CajaServicio cajaServ;

    @GetMapping("/listar")
    public ResponseEntity<CajaEntity> listarAll(){
        ArrayList<CajaEntity> lista = cajaServ.listarAll();
        return new ResponseEntity(lista, HttpStatus.OK);
    }

    @GetMapping("/listar/{caja}")
    public ResponseEntity<CajaEntity> buscarPorId(@PathVariable("caja") long caja){
        if (!cajaServ.existsById(caja))
            return new ResponseEntity("MSG_0006", HttpStatus.NOT_FOUND);

        CajaEntity lista = cajaServ.buscarPorId(caja).get();
        return new ResponseEntity(lista, HttpStatus.OK);
    }

    @PostMapping("/save")
    public ResponseEntity<?> save(@RequestBody CajaModelDto cajaDto){
        if(cajaDto.getDescripcion() == "")
            return new ResponseEntity("MSG_0040", HttpStatus.NOT_FOUND);

        if(cajaServ.existsByDescripcion(cajaDto.getDescripcion()))
            return new ResponseEntity("MSG_0005", HttpStatus.NOT_FOUND);

        CajaEntity caja = new CajaEntity(cajaDto.getDescripcion(),cajaDto.getActivo());
        cajaServ.mantenimientoData(caja);
        return new ResponseEntity("MSG_0001", HttpStatus.OK);
    }

    @PutMapping("/update/{caja}")
    public ResponseEntity<?> update(@PathVariable("caja") Long caja, @RequestBody CajaModelDto cajaDto){

        if(!cajaServ.existsById(caja))
            return new ResponseEntity("MSG_0006", HttpStatus.NOT_FOUND);
        if(cajaDto.getDescripcion() == "")
            return new ResponseEntity("MSG_0040", HttpStatus.BAD_REQUEST);
        if(cajaServ.existsByDescripcion(cajaDto.getDescripcion()) && cajaServ.buscarPorDescripcion(cajaDto.getDescripcion()).get().getCaja() != caja)
            return new ResponseEntity("MSG_0005", HttpStatus.BAD_REQUEST);

        CajaEntity cajaEntity = cajaServ.buscarPorId(caja).get();
        cajaEntity.setDescripcion(cajaDto.getDescripcion());
        cajaEntity.setActivo(cajaDto.getActivo());
        cajaServ.mantenimientoData(cajaEntity);
        return new ResponseEntity("MSG_0002", HttpStatus.OK);
    }

    @DeleteMapping("/delete/{caja}")
    public ResponseEntity<?> delete(@PathVariable("caja") Long caja){
        if(!cajaServ.existsById(caja))
            return new ResponseEntity("MSG_0006", HttpStatus.NOT_FOUND);
        cajaServ.delete(caja);
        return new ResponseEntity("MSG_0003", HttpStatus.OK);
    }

}
