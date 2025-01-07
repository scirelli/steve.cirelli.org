<?PHP
interface ICSVPager {
    public function getLines( $nStart, $nOffset, $bHeader );
    public function numberOfLines();
}
?>
