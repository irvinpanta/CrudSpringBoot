package com.softpang.apiAvikarMantenimiento.Controlador;

import com.softpang.apiAvikarMantenimiento.Entity.TipoPagoEntity;
import com.softpang.apiAvikarMantenimiento.Modelo.TipoPagoModelDto;
import com.softpang.apiAvikarMantenimiento.Servicio.TipoPagoServicio;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import java.util.ArrayList;

@RestController
@RequestMapping("/api/tipopago")
@CrossOrigin(origins = "http://localhost:8080")
public class TipoPagoControlador {

    @Autowired
    private TipoPagoServicio tipoPagoServicio;

    @GetMapping("/listar")
    public ResponseEntity<TipoPagoEntity> listarAll(){
        ArrayList<TipoPagoEntity> tipoPagoEntity = tipoPagoServicio.listarAll();
        return new ResponseEntity(tipoPagoEntity, HttpStatus.OK);
    }

    @GetMapping("/listar/{id}")
    public ResponseEntity<TipoPagoEntity> buscarPorId(@PathVariable("id") Long id){
        if (!tipoPagoServicio.existsById(id))
            return new ResponseEntity("MSG_0006", HttpStatus.NOT_FOUND);
        TipoPagoEntity entity = tipoPagoServicio.buscarPorId(id).get();
        return new ResponseEntity(entity, HttpStatus.OK);
    }

    @PostMapping("/save")
    public ResponseEntity<?> save(@RequestBody TipoPagoModelDto tipoPDto){

        if (tipoPDto.getDescripcion() == "")
            return new ResponseEntity("MSG_0040", HttpStatus.NOT_FOUND);
        if(tipoPagoServicio.existsByDescripcion(tipoPDto.getDescripcion()))
            return new ResponseEntity("MSG_0005", HttpStatus.NOT_FOUND);

        TipoPagoEntity entity = new TipoPagoEntity(tipoPDto.getDescripcion(), tipoPDto.getActivo(), tipoPDto.getRequiereEfectivo(), tipoPDto.getRequiereNumOperacion());
        tipoPagoServicio.mantenimientoData(entity);
        return new ResponseEntity("MSG_0001", HttpStatus.OK);
    }

    @PutMapping("/update/{id}")
    public ResponseEntity<?> update(@PathVariable("id") Long id, @RequestBody TipoPagoModelDto tipoPDto){
        if(!tipoPagoServicio.existsById(id))
            return new ResponseEntity("MSG_0006", HttpStatus.NOT_FOUND);
        if (tipoPDto.getDescripcion() == "")
            return new ResponseEntity("MSG_0040", HttpStatus.NOT_FOUND);

        if(tipoPagoServicio.existsByDescripcion(tipoPDto.getDescripcion()) && tipoPagoServicio.buscarPorDescripcion(tipoPDto.getDescripcion()).get().getTipoPago() != id)
            return new ResponseEntity("MSG_0005", HttpStatus.NOT_FOUND);

        TipoPagoEntity tipoPagoEntity = tipoPagoServicio.buscarPorId(id).get();
        tipoPagoEntity.setDescripcion(tipoPDto.getDescripcion());
        tipoPagoEntity.setActivo(tipoPDto.getActivo());
        tipoPagoEntity.setRequiereEfectivo(tipoPDto.getRequiereEfectivo());
        tipoPagoEntity.setRequiereNumOperacion(tipoPDto.getRequiereNumOperacion());

        tipoPagoServicio.mantenimientoData(tipoPagoEntity);
        return new ResponseEntity("MSG_0002", HttpStatus.OK);
    }

    @DeleteMapping("/delete/{id}")
    public ResponseEntity<?> delete(@PathVariable("id") Long id){
        try {
            if(!tipoPagoServicio.existsById(id))
                return new ResponseEntity("MSG_0006", HttpStatus.NOT_FOUND);
            tipoPagoServicio.delete(id);
            return new ResponseEntity("MSG_0003", HttpStatus.OK);
        }catch (Exception ex){
            return new ResponseEntity("MSG_0030", HttpStatus.CONFLICT);
        }

    }
}
