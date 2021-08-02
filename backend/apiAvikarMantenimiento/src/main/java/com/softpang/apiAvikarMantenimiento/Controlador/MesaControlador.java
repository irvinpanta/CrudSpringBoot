package com.softpang.apiAvikarMantenimiento.Controlador;

import com.softpang.apiAvikarMantenimiento.Entity.MesaEntity;
import com.softpang.apiAvikarMantenimiento.Modelo.MesaModelDto;
import com.softpang.apiAvikarMantenimiento.Servicio.MesaServicio;
import com.softpang.apiAvikarMantenimiento.Servicio.SalonServicio;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import java.util.ArrayList;

@RestController
@RequestMapping("/api/mesas")
@CrossOrigin
public class MesaControlador {

    @Autowired
    private MesaServicio mesaServicio;

    @Autowired
    private SalonServicio salonServicio;

    @GetMapping("/listar")
    public ResponseEntity<ArrayList<MesaEntity>> listarAll(){
        ArrayList<MesaEntity> lista = mesaServicio.listarAll();
        return ResponseEntity.ok(lista);
    }

    @GetMapping("/listar/{id}")
    public ResponseEntity<MesaEntity> buscarPorId(@PathVariable("id") int id){
        if(!mesaServicio.existsById(id))
            return new ResponseEntity("MSG_0006", HttpStatus.NOT_FOUND);
        MesaEntity mesa = mesaServicio.buscarPorId(id).get();
        return new ResponseEntity(mesa, HttpStatus.OK);
    }

    @PostMapping("/save")
    public ResponseEntity<?> save(@RequestBody MesaModelDto mesaDto){
        if(mesaServicio.existsByDescripcion(mesaDto.getDescripcion()))
            return new ResponseEntity("MSG_0005", HttpStatus.NOT_FOUND);
        if(mesaDto.getDescripcion() == "")
            return new ResponseEntity("MSG_0040", HttpStatus.NOT_FOUND);
        if(!salonServicio.existsById(mesaDto.getSalon().getSalon()))
            return new ResponseEntity("MSG_0040", HttpStatus.NOT_FOUND);

        MesaEntity mesa = new MesaEntity(mesaDto.getDescripcion(), mesaDto.getCantidad(), mesaDto.getActivo(), mesaDto.getMesarapida(), mesaDto.getSalon());
        mesaServicio.mantenimientoData(mesa);
        return new ResponseEntity("MSG_0001", HttpStatus.OK);
    }

    @PutMapping("/update/{id}")
    public ResponseEntity<?> update(@PathVariable("id") int id, @RequestBody MesaModelDto mesaDto){
        if(!mesaServicio.existsById(id))
            return new ResponseEntity("MSG_0006", HttpStatus.NOT_FOUND);
        if(mesaDto.getDescripcion() == "")
            return new ResponseEntity("MSG_0040", HttpStatus.NOT_FOUND);
        if(!salonServicio.existsById(mesaDto.getSalon().getSalon()))
            return new ResponseEntity("MSG_0040", HttpStatus.NOT_FOUND);
        if(mesaServicio.existsByDescripcion(mesaDto.getDescripcion()) && mesaServicio.buscarPorDescripcion(mesaDto.getDescripcion()).get().getMesa() != id)
            return new ResponseEntity("MSG_0005", HttpStatus.NOT_FOUND);

        MesaEntity mesa = mesaServicio.buscarPorId(id).get();
        mesa.setDescripcion(mesaDto.getDescripcion());
        mesa.setCantidad(mesaDto.getCantidad());
        mesa.setActivo(mesaDto.getActivo());
        mesa.setMesarapida(mesaDto.getMesarapida());
        mesa.setSalon(mesaDto.getSalon());
        mesaServicio.mantenimientoData(mesa);
        return new ResponseEntity("MSG_0002", HttpStatus.OK);
    }

    @DeleteMapping("/delete/{id}")
    public ResponseEntity<?> delete(@PathVariable("id") int id){
        try {
            if(!mesaServicio.existsById(id))
                return new ResponseEntity("MSG_0006", HttpStatus.NOT_FOUND);
            mesaServicio.delete(id);
            return new ResponseEntity("MSG_0003", HttpStatus.OK);
        }catch (Exception ex){
            return new ResponseEntity("MSG_0030", HttpStatus.CONFLICT);
        }

    }
}
