/* SP Create Update Delete Books */
DELIMITER //
CREATE PROCEDURE sp_books_cud(
    idBuku int,
    namaBuku text,
    namaPengarang text,
    namaPenerbit text,
    tahunTerbit int(4),
    idKlasifikasi varchar(25),
    flagPinjam bit(1).
    idKategori int,
    idISBN varchar(13),
    unitPrice decimal(18,2),
    serialNumber varchar(255),
    idJilid int,
    currentUser varchar(255),
    flag bit(1)
)
BEGIN
    DECLARE hasil int,historyDesc text, hisCode char(5), lastID int;
    SET hisCode = 'BOOKS';
    IF idBuku IS NULL THEN
        INSERT INTO buku(
            NamaBuku,
            NamaPengarang,
            NamaPenerbit,
            TahunTerbit,
            ID_Klasifikasi,
            FlagPinjam,
            ID_Kategori,
            ID_ISBN,
            UnitPrice,
            SerialNumber,
            ID_Jilid
        ) 
        VALUES(
            namaBuku,
            namaPengarang,
            namaPenerbit,
            tahunTerbit,
            idKlasifikasi,
            flagPinjam,
            idKategori,
            idISBN,
            unitPrice,
            serialNumber,
            idJilid
        );
        SET hasil = 1;
        SET historyDesc = CONCAT(namaBuku, ' created by ', currentUser);
        SET idBuku = LAST_INSERT_ID();
    ELSE IF flag = 1 THEN
        UPDATE buku 
        SET 
            NamaBuku = namaBuku,
            NamaPengarang = namaPengarang,
            NamaPenerbit = namaPenerbit,
            TahunTerbit = tahunTerbit,
            ID_Klasifikasi = idKlasifikasi,
            FlagPinjam = flagPinjam,
            ID_Kategori = idKategori,
            ID_ISBN = idISBN,
            UnitPrice = unitPrice,
            SerialNumber = serialNumber,
            ID_Jilid = idJilid
        WHERE 
            ID_Buku = idBuku;
        SET hasil = 1;
        SET historyDesc = CONCAT(namaBuku, ' updated by ', currentUser);
    ELSE IF flag = 0 THEN
        UPDATE buku 
        SET 
            FlagActive = 0 
        WHERE 
            ID_Buku = idBuku;
        SET hasil = 1;
        SET historyDesc = CONCAT(namaBuku, ' deleted by ', currentUser);
    END IF;
    END IF;
    END IF;
    CALL sp_history_insert(historyDesc, hisCode, idBuku, currentUser);
    SELECT hasil AS Result;
END; //
DELIMITER ;

/* SELECT BOOK ALL */
DELIMITER //
CREATE PROCEDURE sp_book_select_all()
BEGIN
    SELECT ID_Buku, NamaBuku, NamaPengarang, NamaPenerbit, TahunTerbit, ID_Klasifikasi, FlagPinjam, ID_Kategori, ID_ISBN, UnitPrice, SerialNumber, ID_Jilid FROM buku;
END; //
DELIMITER ;

/* SELECT BOOK BY BOOK ID */
DELIMITER //
CREATE PROCEDURE sp_book_detail(
    idBuku int
)
BEGIN
    SELECT ID_Buku, NamaBuku, NamaPengarang, NamaPenerbit, TahunTerbit, ID_Klasifikasi, FlagPinjam, ID_Kategori, ID_ISBN, UnitPrice, SerialNumber, ID_Jilid FROM buku WHERE ID_Buku = idBuku;
END; //
DELIMITER ;

/* */
DELIMITER //
CREATE PROCEDURE sp_login_select_password_by_username()
BEGIN
END; //
DELIMITER ;

/* */
DELIMITER //
CREATE PROCEDURE sp_member_select_all()
BEGIN
END; //
DELIMITER ;

/* */
DELIMITER //
CREATE PROCEDURE sp_member_select_by_id(
    idMember int
)
BEGIN
END; //
DELIMITER ;

/* */
DELIMITER //
CREATE PROCEDURE sp_peminjaman_select_all()
BEGIN
END; //
DELIMITER ;

/* SELECT PEMINJAMAN BY ID MEMBER */
DELIMITER //
CREATE PROCEDURE sp_peminjaman_select_by_id_member()
BEGIN
END; //
DELIMITER ;

/* SELECT PEMINJAM BY BOOK */
DELIMITER //
CREATE PROCEDURE sp_peminjaman_select_by_book()
BEGIN
END; //
DELIMITER ;

/* CUD Member */
DELIMITER //
CREATE PROCEDURE sp_member_cud()
BEGIN
END; //
DELIMITER ;

/* CUD Peminjaman */
DELIMITER //
CREATE PROCEDURE sp_peminjaman_cud()
BEGIN
END; //
DELIMITER ;

/* CUD Login */
DELIMITER //
CREATE PROCEDURE sp_login_cud()
BEGIN
END; //
DELIMITER ;

/* Trace history */
DELIMITER //
CREATE PROCEDURE sp_history_insert(
    historyDetail text,
    historyCode char(5),
    historyDetailCode int,
    currentUser varchar(255)
)
BEGIN
    INSERT INTO history(HistoryDesc, HistoryCode,HistoryDetailCode, ModifiedBy) VALUES(historyDetail, historyCode, historyDetailCode, currentUser);
END; //
DELIMITER ;

/* GET History by  */
DELIMITER //
CREATE PROCEDURE sp_history_select(
    historyCode char(5),
    historyDetailCode int
)
BEGIN
    SELECT HistoryDesc, HistoryCode,HistoryDetailCode, ModifiedBy, ModifiedDate FROM history WHERE HistoryCode = historyCode AND HistoryDetailCode = historyDetailCode;
END; //
DELIMITER ;