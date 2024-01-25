package com.example.singer_songs.data;

import java.util.List;
import java.util.Optional;

import org.springframework.data.jpa.repository.JpaRepository;

import com.example.singer_songs.models.Song;

public interface SongRepository extends JpaRepository<Song,Long>{
    Optional<List<Song>> findBySingerId(Long id);
}
