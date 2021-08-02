package com.softpang.apiAvikarMantenimiento.Controlador;

import com.softpang.apiAvikarMantenimiento.Entity.TipoOperacionEntity;
import com.softpang.apiAvikarMantenimiento.Modelo.TipoOperacionModelDto;
import com.softpang.apiAvikarMantenimiento.Servicio.TipoOperacionServicio;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.boot.env.RandomValuePropertySourceEnvironmentPostProcessor;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import java.util.ArrayList;

@RestController
@RequestMapping("/api/tipooperacion")
@CrossOrigin(origins = "http:localhost:8080")
public class TipoOperacionControlador {

    @Autowired
    private TipoOperacionServicio tipoOperacionServ;

    @GetMapping("/listar")
    public ResponseEntity<TipoOperacionEntity> listarAll(){
        ArrayList<TipoOperacionEntity> lista = tipoOperacionServ.listarAll();
        return new ResponseEntity(lista, HttpStatus.OK);
    }

    @GetMapping("listar/{tipoO}")
    public ResponseEntity<TipoOperacionEntity> buscarPorId(@PathVariable("tipoO") Long tipoO){
        if (!tipoOperacionServ.existsById(tipoO))
            return new ResponseEntity("MSG_0006", HttpStatus.NOT_FOUND);

        TipoOperacionEntity tipoEntity = tipoOperacionServ.buscarPorId(tipoO).get();
        return new ResponseEntity(tipoEntity, HttpStatus.NOT_FOUND);
    }

    @PostMapping("/save")
    public ResponseEntity<?> save(@RequestBody TipoOperacionModelDto tipoODto){
        if(tipoOperacionServ.existsByDescripcion(tipoODto.getDescripcion()))
            return new ResponseEntity("MSG_0005", HttpStatus.NOT_FOUND);
        if (tipoODto.getDescripcion() == "")
            return new ResponseEntity("MSG_0040", HttpStatus.NOT_FOUND);

        TipoOperacionEntity tipoOperacionEntity = new TipoOperacionEntity(tipoODto.getDescripcion(), tipoODto.getActivo());
        tipoOperacionServ.mantenimientoData(tipoOperacionEntity);

        return new ResponseEntity("MSG_0001", HttpStatus.OK);
    }

    @PutMapping("/update/{tipoO}")
    public ResponseEntity<?> update(@PathVariable("tipoO") Long tipoO, @RequestBody TipoOperacionModelDto tipoODto){

        if(!tipoOperacionServ.existsById(tipoO))
            return new ResponseEntity("MSG_0006", HttpStatus.NOT_FOUND);
        if (tipoODto.getDescripcion() == "")
            return new ResponseEntity("MSG_0040", HttpStatus.NOT_FOUND);
        if(tipoOperacionServ.existsByDescripcion(tipoODto.getDescripcion()) && tipoOperacionServ.buscarPorDescripcion(tipoODto.getDescripcion()).get().getTipoOperacion() != tipoO )
            return new ResponseEntity("MSG_0005", HttpStatus.NOT_FOUND);

        TipoOperacionEntity tipoOperacionEntity = tipoOperacionServ.buscarPorId(tipoO).get();
        tipoOperacionEntity.setDescripcion(tipoODto.getDescripcion());
        tipoOperacionEntity.setActivo(tipoODto.getActivo());

        tipoOperacionServ.mantenimientoData(tipoOperacionEntity);
        return new ResponseEntity("MSG_0002", HttpStatus.OK);
    }

    @DeleteMapping("/delete/{tipoO}")
    public ResponseEntity<?> delete(@PathVariable("tipoO") Long tipoOpera){
        try {
            if(!tipoOperacionServ.existsById(tipoOpera))
                return new ResponseEntity("MSG_0006", HttpStatus.NOT_FOUND);

            tipoOperacionServ.delete(tipoOpera);
            return new ResponseEntity("MSG_0003", HttpStatus.OK);
        }catch (Exception ex){
            return new ResponseEntity("MSG_0030", HttpStatus.CONFLICT);
        }


    }

}
