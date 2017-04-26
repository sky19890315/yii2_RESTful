using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace API_Demo
{
    public class APIFile
    {
        #region 变量
        #region FileName
        private string fileName;
        public string FileName
        {
            get { return fileName; }
            set { fileName = value; }
        }
        #endregion
        #region FilePath_Id
        private string filePath_Id;
        public string FilePath_Id
        {
            get { return filePath_Id; }
            set { filePath_Id = value; }
        }
        #endregion
        #region FilePath
        private string filePath;
        public string FilePath
        {
            get { return filePath; }
            set { filePath = value; }
        }
        #endregion
        #endregion

    }
}
