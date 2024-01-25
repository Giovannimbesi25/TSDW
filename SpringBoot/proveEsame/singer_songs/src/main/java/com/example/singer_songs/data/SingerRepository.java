package com.example.singer_songs.data;

import java.util.List;

import org.springframework.data.jpa.repository.JpaRepository;

import com.example.singer_songs.models.Singer;

public interface SingerRepository extends JpaRepository<Singer, Long>{
    Singer findBySongsNome(String songName);

    Singer findByNomeOrCognome(String nome, String cognome);
}
