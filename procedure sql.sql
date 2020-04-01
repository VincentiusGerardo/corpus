/* SP Create Update Delete Books */
DELIMITER //
CREATE PROCEDURE sp_books_cud(
    idBuku int,
    namaBuku text,
    namaPengarang text,
    namaPenerbit text,
    tahunTerbit int(4),
    idKlasifikasi varchar(25),
    flagPinjam BOOLEAN,
    idKategori int,
    idISBN varchar(13),
    unitPrice decimal(18,2),
    serialNumber varchar(255),
    idJilid int,
    currentUser varchar(255),
    flag BOOLEAN
)
BEGIN
    DECLARE hasil int;
    DECLARE historyDesc text;
    DECLARE hisCode char(5);
    DECLARE newID int;
    SET hisCode = 'BOOKS';
    SET newID = (SELECT CONCAT(YEAR(NOW()), RIGHT(MAX(ID_Buku)+1,4)) from buku);
    IF flag IS NULL THEN
        INSERT INTO buku(
            ID_Buku,
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
            ID_Jilid,
            FlagActive
        ) 
        VALUES(
            newID,
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
            idJilid,
            1
        );
        SET hasil = 1;
        SET historyDesc = CONCAT(namaBuku, ' created by ', currentUser);
        SET idBuku = newID;
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
            FlagActive = 1 AND 
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
    CALL sp_history_insert(idBuku, hisCode,historyDesc, currentUser);
    SELECT hasil AS Result;
END; //
DELIMITER ;

/* CUD Member */
DELIMITER //
CREATE PROCEDURE sp_member_cud(
    idMember int,
    NamaMember text,
    noHP varchar(15),
    alamat text,
    currentUser varchar(255),
    flagActive BOOLEAN
)
BEGIN
    DECLARE hasil int;
    DECLARE historyDesc text;
    DECLARE hisCode char(5);
    DECLARE newID int;
    SET hisCode = 'MEMBR';
    IF flagActive IS NULL THEN
    SET newID = (SELECT CONCAT(RIGHT(YEAR(NOW()),2), RIGHT(MAX(ID_Member)+1,3)) from member);
        INSERT INTO member(
            ID_Member,
            NamaMember,
            NoHP,
            Alamat
        ) VALUES(
            newID,
            namaMember,
            noHP,
            alamat
        );
        SET hasil = 1;
        SET historyDesc = CONCAT(namaMember, ' added by ', currentUser);
        SET idMember = newID;
    ELSE IF flagActive = 1 THEN
        UPDATE
            member
        SET
            NamaMember = namaMember,
            NoHP = noHP,
            Alamat = alamat
        WHERE
            FlagActive = 1 AND
            ID_Member = idMember;
        SET hasil = 1;
        SET historyDesc = CONCAT(namaMember, ' edited by ', currentUser);       
    ELSE IF flagActive = 0 THEN 
     UPDATE
            member
        SET
            FlagActive = 0
        WHERE
            ID_Member = idMember;
        SET hasil = 1;
        SET historyDesc = CONCAT(namaMember, ' deleted by ', currentUser);
    END IF;
    END IF;
    END IF;
    CALL sp_history_insert(idMember, hisCode,historyDesc, currentUser);
    SELECT hasil AS Result;
END; //
DELIMITER ;

/* CUD Peminjaman */
DELIMITER //
CREATE PROCEDURE sp_peminjaman(
    idPeminjaman int,
    idBuku int,
    idMember int,
    TanggalPinjam date,
    TanggalKembali date,
    flagKembali boolean,
    currentUser varchar(255)
)
BEGIN
    DECLARE hasil int;
    DECLARE historyDesc text;
    DECLARE hisCode char(5);
    DECLARE bookName text;
    DECLARE memberName text;
    SET hisCode = 'PNJAM';
    IF idPeminjaman IS NULL THEN
        INSERT INTO peminjaman(
            ID_Buku,
            ID_Member,
            TanggalPinjam,
            TanggalKembali,
            FlagSudahKembali
        )
        VALUES(
            idBuku,
            idMember,
            TanggalPinjam,
            TanggalKembali,
            0
        );
        SELECT NamaBuku into bookName from buku where FlagActive = 1 AND ID_Buku = idBuku;
        SELECT NamaMember into memberName from member where FlagActive = 1 AND ID_Member = idMember;
        SET hasil = 1;
        SET historyDesc = CONCAT(NamaMember, ' borrowed a book called ', currentUser);
        SET idBuku = LAST_INSERT_ID();
        CALL sp_history_insert(idMember, hisCode,historyDesc, currentUser);
        SELECT hasil AS Result;
    END IF;
END; //
DELIMITER ;

/* CUD Login */
DELIMITER //
CREATE PROCEDURE sp_login_cud(
    idLogin int,
    userName text,
    fullName text,
    pass text,
    flag boolean,
    currentUser varchar(255)
)
BEGIN
    DECLARE hasil int;
    DECLARE historyDesc text;
    DECLARE hisCode char(5);
    SET hisCode = 'LOGIN';
    IF idLogin IS NULL THEN
        INSERT INTO login(
            Username,
            FullName,
            Password
        ) VALUES(
            userName,
            fullName,
            pass
        );
        SET hasil = 1;
        SET historyDesc = CONCAT(FullName, ' added by ', currentUser);
        SET idLogin = LAST_INSERT_ID();
    ELSE IF flag = 1 THEN
        UPDATE
            login
        SET
            Username = userName,
            FullName = fullName,
            Password = pass
        WHERE
            FlagActive = 1 AND
            ID_Login = idLogin;
        SET hasil = 1;
        SET historyDesc = CONCAT(FullName, ' updated by ', currentUser);
    ELSE IF flag = 0 THEN
        UPDATE
            login
        SET
            FlagActive = 0
        WHERE
            ID_Login = idLogin;
        SET hasil = 1;
        SET historyDesc = CONCAT(FullName, ' deleted by ', currentUser);
    END IF;
    END IF;
    END IF;
    CALL sp_history_insert(idLogin, hisCode,historyDesc, currentUser);
    SELECT hasil AS Result;
END; //
DELIMITER ;

/* SELECT BOOK ALL */
DELIMITER //
CREATE PROCEDURE sp_book_select_all()
BEGIN
    SELECT a.ID_Buku, a.NamaBuku, a.NamaPengarang, a.NamaPenerbit, a.TahunTerbit, a.ID_Klasifikasi, a.FlagPinjam, a.ID_Kategori, b.NamaKategori, a.ID_ISBN, a.UnitPrice, a.SerialNumber, a.ID_Jilid
FROM buku a, kategori b
WHERE a.ID_Kategori = b.ID_Kategori AND
a.FlagActive = 1;
END; //
DELIMITER ;

/* SELECT BOOK BY BOOK ID */
DELIMITER //
CREATE PROCEDURE sp_book_detail(
    idBuku int
)
BEGIN
    SELECT a.ID_Buku, a.NamaBuku, a.NamaPengarang, a.NamaPenerbit, a.TahunTerbit, a.ID_Klasifikasi, a.FlagPinjam, a.ID_Kategori, b.NamaKategori, a.ID_ISBN, a.UnitPrice, a.SerialNumber, a.ID_Jilid
FROM buku a, kategori b
WHERE a.ID_Kategori = b.ID_Kategori AND
a.FlagActive = 1 AND a.ID_Buku = idBuku;
END; //
DELIMITER ;

/* GET PASSWORD FROM USERNAME */
DELIMITER //
CREATE PROCEDURE sp_login_select_password_by_username(
    username varchar(255)
)
BEGIN
    SELECT Password FROM login WHERE FlagActive = 1 AND Username = username;
END; //
DELIMITER ;

/* GET ID FROM USERNAME */
DELIMITER //
CREATE PROCEDURE sp_login_select_id_login_by_username(
    username varchar(255)
)
BEGIN
    SELECT ID_Login FROM login WHERE FlagActive = 1 AND Username = username;
END; //
DELIMITER ;

/* SELECT ALL MEMBER  */
DELIMITER //
CREATE PROCEDURE sp_member_select_all()
BEGIN
    SELECT ID_Member, NamaMember, NoHP, Alamat FROM member WHERE FlagActive = 1;
END; //
DELIMITER ;

/* GET MEMBER DETAIL BY ID */
DELIMITER //
CREATE PROCEDURE sp_member_select_by_id(
    idMember int
)
BEGIN
    SELECT ID_Member, NamaMember, NoHP, Alamat FROM member WHERE FlagActive = 1 AND ID_Member = idMember;
END; //
DELIMITER ;

/* */
DELIMITER //
CREATE PROCEDURE sp_peminjaman_select_all()
BEGIN
    SELECT 
        aa.ID_Peminjaman, aa.ID_Buku, aa.NamaBuku, aa.ID_Member , bb.NamaMember, aa.TanggalPinjam, aa.TanggalKembali, aa.FlagSudahKembali 
    FROM (
        SELECT 
            a.ID_Peminjaman, a.ID_Buku, b.NamaBuku, a.ID_Member, a.TanggalPinjam, a.TanggalKembali, a.FlagSudahKembali 
        FROM peminjaman a INNER JOIN buku b 
        ON  a.ID_Buku = b.ID_Buku
    ) aa INNER JOIN member bb 
    ON aa.ID_Member = bb.ID_Member;
END; //
DELIMITER ;

/* SELECT PEMINJAMAN BY ID MEMBER */
DELIMITER //
CREATE PROCEDURE sp_peminjaman_select_by_id_member(
    idMember int
)
BEGIN
    SELECT 
        aa.ID_Peminjaman, aa.ID_Buku, aa.NamaBuku, aa.ID_Member , bb.NamaMember, aa.TanggalPinjam, aa.TanggalKembali, aa.FlagSudahKembali 
    FROM (
        SELECT 
            a.ID_Peminjaman, a.ID_Buku, b.NamaBuku, a.ID_Member, a.TanggalPinjam, a.TanggalKembali, a.FlagSudahKembali 
        FROM peminjaman a INNER JOIN buku b 
        ON  a.ID_Buku = b.ID_Buku
    ) aa INNER JOIN member bb 
    ON aa.ID_Member = bb.ID_Member
    WHERE aa.ID_Member = idMember;
END; //
DELIMITER ;

/* SELECT PEMINJAM BY BOOK */
DELIMITER //
CREATE PROCEDURE sp_peminjaman_select_by_book(
    idBuku int
)
BEGIN
    SELECT 
        aa.ID_Peminjaman, aa.ID_Buku, aa.NamaBuku, aa.ID_Member , bb.NamaMember, aa.TanggalPinjam, aa.TanggalKembali, aa.FlagSudahKembali 
    FROM (
        SELECT 
            a.ID_Peminjaman, a.ID_Buku, b.NamaBuku, a.ID_Member, a.TanggalPinjam, a.TanggalKembali, a.FlagSudahKembali 
        FROM peminjaman a INNER JOIN buku b 
        ON  a.ID_Buku = b.ID_Buku
    ) aa INNER JOIN member bb 
    ON aa.ID_Member = bb.ID_Member
    WHERE aa.ID_Buku = idBuku;
END; //
DELIMITER ;

/* Trace history */
DELIMITER //
CREATE PROCEDURE sp_history_insert(
    historyRefID int,
    historyRefCode char(5),
    historyDetail text,
    currentUser varchar(255)
)
BEGIN
    INSERT INTO history
    (
        RefID,
        RefCode,
        HistoryDesc,
        CreatedBy
    ) 
    VALUES
    (
        historyRefID,
        historyRefCode,
        historyDetail,
        currentUser
    );
END; //
DELIMITER ;

/* GET History by  history code*/
DELIMITER //
CREATE PROCEDURE sp_history_select(
    historyCode char(5),
    historyDetailCode int
)
BEGIN
    SELECT HistoryDesc, HistoryCode,HistoryDetailCode, ModifiedBy, ModifiedDate FROM history WHERE HistoryCode = historyCode AND HistoryDetailCode = historyDetailCode;
END; //
DELIMITER ;

/* GET FULL NAME FROM USERNAME */
DELIMITER //
CREATE PROCEDURE sp_login_select_fullname_by_username(
    username varchar(255)
)
BEGIN
    SELECT FullName FROM login WHERE FlagActive = 1 AND Username = username;
END; //
DELIMITER ;

/* GET DATA USER FROM USERNAME */
DELIMITER //
CREATE PROCEDURE sp_login_select_userdata_by_username(
    username varchar(255)
)
BEGIN
    SELECT ID_Login,Username,FullName FROM login WHERE FlagActive = 1 AND Username = username;
END; //
DELIMITER ;

/* GET NEXT ID For member */
DELIMITER //
CREATE PROCEDURE sp_member_get_next_id()
BEGIN
    SELECT CONCAT(RIGHT(YEAR(NOW()),2), RIGHT(MAX(ID_Member)+1,3)) as NewID from member;
END; //
DELIMITER ;


/* GET NEXT ID For Book */
DELIMITER //
CREATE PROCEDURE sp_book_get_next_id()
BEGIN
    SELECT CONCAT(RIGHT(YEAR(NOW()),2), RIGHT(MAX(ID_Buku)+1,4)) from buku;
END; //
DELIMITER ;