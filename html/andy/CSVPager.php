<?PHP
require('ICSVPager.php');

class CSVPager implements ICSVPager{
    private $sFile       = '';
    private $hFileHandle = null;
    private $sHeaderLine = '';
    private $nBytesRead  = 0;
    private $nLineCount  = 0;

    public function __construct( $sFile ){
        $this->sFile = $sFile;
        $this->openFile( $sFile );
        $this->getHeader();
    }

    public function __destruct(){
        fclose($this->hFileHandle);
    }

    public function openFile( $sFile ){
        if( is_readable( $sFile ) ){
            $this->hFileHandle = fopen( $sFile, 'r' );
        }else{
            throw new Exception('Could not open file for reading: ' . $sFile);
        }
    }
    
    public function getLines( $nStart, $nOffset, $bHeader=false ){
        if( $this->hFileHandle ){
            $aRtn = array();

            if( $bHeader ) $aRtn[] = $this->sHeaderLine;

            $this->seek( $nStart );
            for( $i=0,$str=''; $i<$nOffset; $i++ ){
                $str = fgetcsv($this->hFileHandle);
                $aRtn[] = $str;
            }
            fseek($this->hFileHandle,0);
            return $aRtn;
        }else{
            throw new Exception('File hangle is not valid. Try opening the file first.');
        }

        return array();
    }
    
    public function numberOfLines(){
        if( $this->nLineCount <= 0 ){
            $cnt = 0;
            while( fgets($this->hFileHandle) ){
                $cnt++;
            }
            $this->nLineCount = $cnt;
            fseek($this->hFileHandle,0);
        }

        return $this->nLineCount;
    }

    private function seek( $nLineNumber ){
        $nLineNumber = intval($nLineNumber);
        for( $i=0,$str=''; $i<$nLineNumber; $i++ ){
            $str = fgets($this->hFileHandle);
            $this->nBytesRead += strlen($str);
        }
    }

    private function getHeader(){
        $this->sHeaderLine = fgets($this->hFileHandle);
        fseek($this->hFileHandle,0);
    }
}
?>
